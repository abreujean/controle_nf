$(function () {

  //Initialize Select2 Elements
  $('.select').select2().data('select2').$selection.css('height', '40px');

  InitializeGraphic();

})

/**
 * Function to initialize graphic
 * @param {*} year 
 */
const InitializeGraphic = (year = new Date().getFullYear()) => {

  salesChart(year);
  visitorsChart(year);
  countAllInvoicesByYears(year);
  sumtAllInvoicesByYears(year);
  sumValueAllExpenseByYears(year);
  retrieveAvailableBillingAmount(year);
  listSumMonthInvoiceByYear(year);
  donutChart(year);

}


$("#graphic-year").on( "change", function() {

  InitializeGraphic($("#graphic-year").val());

});


/**
 * Load graphic 
 */
const countAllInvoicesByYears = (year) => {

  $.get({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/' + PREFIX + '/count-invoices-years' + '/' + year,
    dataType: 'json',
    type: 'GET',
    //data: 'year='+year,
    success: function (data) {
      $("#invoice-count").text(data);
    },
    error: function (jqXHR, status, error) {

    }
  });

}


/**
 * Load graphic 
 */

const sumtAllInvoicesByYears = (year) => {

  $.get({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/' + PREFIX + '/sum-value-invoices-years' + '/' + year,
    dataType: 'json',
    type: 'GET',
    //data: 'year='+year,
    success: function (data) {

      $("#invoice-value-sum").text(data.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
    },
    error: function (jqXHR, status, error) {

    }
  });
}

/**
 * Load graphic 
 */
const sumValueAllExpenseByYears = (year) => {

  $.get({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/' + PREFIX + '/sum-value-expense-years' + '/' + year,
    dataType: 'json',
    type: 'GET',
    //data: 'year='+year,
    success: function (data) {

      $("#expense-value-sum").text(data.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
    },
    error: function (jqXHR, status, error) {

    }
  });

}



/**
 * Load graphic 
 */
const retrieveAvailableBillingAmount = (year) => {

  $.get({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/' + PREFIX + '/retrieve-available-billing-amount' + '/' + year,
    dataType: 'json',
    type: 'GET',
    //data: 'year='+year,
    success: function (data) {
      $("#available-billing").text(data.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
    },
    error: function (jqXHR, status, error) {

    }
  });

}


/**
 * Load graphic 
 */

const listSumMonthInvoiceByYear = (year) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/' + PREFIX + '/list-sum-month-invoice/' + year,
      dataType: 'json',
      type: 'GET',
      success: function (data) {
        resolve(Object.values(data).map(obj => parseFloat(obj.total)));
      },
      error: function (jqXHR, status, error) {
        reject(error);
      }
    });
  });
};


const listSumMonthExpenseByYear = (year) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/' + PREFIX + '/list-sum-month-expense/' + year,
      dataType: 'json',
      type: 'GET',
      success: function (data) {
        resolve(Object.values(data).map(obj => parseFloat(obj.total)));
      },
      error: function (jqXHR, status, error) {
        reject(error);
      }
    });
  });
};


const simpleBalanceInvoiceAndExpenseByYear = (year) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/' + PREFIX + '/simple-balance-invoice-expense/' + year,
      dataType: 'json',
      type: 'GET',
      success: function (data) {
        resolve(Object.values(data).map(obj => parseFloat(obj.total)));
      },
      error: function (jqXHR, status, error) {
        reject(error);
      }
    });
  });
};


const sumExpensesCategoryByYear = (year) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/' + PREFIX + '/sum-expenses-for-category/' + year,
      dataType: 'json',
      type: 'GET',
      success: function (data) {
        resolve(data);
      },
      error: function (jqXHR, status, error) {
        reject(error);
      }
    });
  });
};


const salesChart = async (year) => {

  'use strict'

  

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')

  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: await listSumMonthInvoiceByYear(year)
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: await listSumMonthExpenseByYear(year)
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            callback: function (value) {
              return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

}

const visitorsChart = async (year) => {

  'use strict'


  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $visitorsChart = $('#visitors-chart')

  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      datasets: [{
        type: 'line',
        data: await simpleBalanceInvoiceAndExpenseByYear(year),
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            callback: function (value) {
              return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

}

const donutChart = async (year) => {

  // Donut Chart
  var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
  var pieData = {
    labels: Object.values(await sumExpensesCategoryByYear(year)).map(obj =>(obj.category)),
    datasets: [
      {
        data: Object.values(await sumExpensesCategoryByYear(year)).map(obj => parseFloat(obj.total)),
        backgroundColor: [
          '#f56954', '#00a65a', '#f39c12', '#3c8dbc', '#d2d6de', '#605ca8', '#00c0ef', '#dd4b39', '#39cccc', '#7d4cdb',
          '#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#800080', '#008000', '#000080', '#808080'
        ],
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    },
    maintainAspectRatio: false,
    responsive: true
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

}