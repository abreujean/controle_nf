# Controle de nota fiscal

## Descrição breve do sistema.

Funcionalidades

Link dos video de apresentação so sistema

Parte 1 - https://www.youtube.com/watch?v=vojK04bnKFw

Parte 2 - https://www.youtube.com/watch?v=K57NzcFjfRk

Usuarios de teste
srvibbraneo@gmail.com
senha: 123456
jeandcabreu@gmail.com
senha: 123456

1.Tela Principal:

Após o login, o usuário é redirecionado para a tela principal.
A tela principal possui um menu com opções de preferências e histórico de lançamentos.
Há botões rápidos para lançar uma Nota Fiscal e lançar uma Despesa.
Os dashboards apresentam informações para rápida visualização, como:
Gráfico indicativo do valor disponível de faturamento para emitir uma Nota Fiscal sem desenquadramento como MEI.
Gráficos com o valor de Notas Fiscais geradas mês a mês.
Gráficos com o valor de despesas mês a mês.
Gráficos com balanço simples, mostrando receitas - despesas mês a mês.
Gráficos com as despesas por categorias.
É possível escolher o ano para visualização de dados históricos.

2.Editar Preferências:

No menu de preferências, o usuário pode cadastrar empresas parceiras, categorias de despesas e alterar configurações do sistema.
É possível cadastrar e editar empresas parceiras, informando CNPJ, nome da empresa e razão social.
É possível cadastrar e editar categorias de despesas, informando nome da categoria e descrição.
As categorias podem ser arquivadas, ocultando-as na listagem ao lançar uma nova despesa.
É possível configurar o limite máximo de faturamento do MEI e o recebimento de alertas de faturamento por e-mail e SMS.

3.Lançar Nota Fiscal:

Para lançar uma nova Nota Fiscal, o usuário seleciona uma empresa através da busca por CNPJ ou nome da empresa.
São informados o valor da Nota Fiscal, número da Nota Fiscal, descrição do serviço prestado, mês de competência e data de recebimento.
É possível posteriormente excluir ou editar qualquer campo do lançamento da Nota Fiscal.

4.Lançar Despesas:

Para lançar uma nova Despesa, o usuário escolhe uma categoria através da busca por nome.
São informados o valor da despesa, nome da despesa, data de pagamento e data de competência.
É possível vincular a despesa a uma empresa para a qual um serviço foi prestado.
É possível posteriormente excluir ou editar qualquer campo do lançamento da Despesa.

5.Notificação de Faturamento:

É possível configurar o recebimento de alertas de faturamento.
Os alertas são enviados por e-mail ou SMS, de acordo com as preferências do usuário.
Todo dia 01 do mês, é enviada uma notificação mensal de limite, informando o valor que ainda pode ser emitido em Notas Fiscais sem desenquadramento como MEI.
Ao atingir 80% do limite de faturamento anual do MEI, é enviado um alerta informando que o usuário está próximo de ser desenquadrado, juntamente com os procedimentos que deve adotar para evitar o pagamento de multas.

## Tecnologias Utilizadas
O sistema foi desenvolvido utilizando as seguintes 

tecnologias:
1. Linguagem de programação: PHP
2. Framework: Laravel 10
3. Banco de Dados: Mysql

Outras tecnologias: 

1. Implementação de requisições AJAX com jQuery para melhorar a interatividade das páginas.
2. Utilização do layout AdminLTE para uma interface de usuário moderna e responsiva.
3. Organização do código utilizando conceitos de orientação a objetos.
4. Criação de modelos de entidades e relacionamentos para a gestão das informações do projeto.
5. Implementação de alertas automáticos para envio de e-mail e SMS utilizando a funcionalidade de agendamento (schedule) do Laravel.
6. Criação de níveis de acesso para colaboradores e administradores, garantindo a segurança e privacidade dos dados

## Requisitos de Instalação

Versão do PHP: 8.2.1
Banco de Dados MySql: 5.2.0
Outras dependências: bootstrap, chart.js, datatables, daterangepicker, fontawesome-free inputmask, jquery, jquery-ui, moment, selec2, sweetalert2

## Instalação e Configuração

1. Certifique-se de ter o ambiente de desenvolvimento Laravel configurado corretamente em sua máquina.
2. Faça o clone deste repositório para seu ambiente local.
3. Acesse o diretório do projeto e execute o comando composer install para instalar as dependências do Laravel.
4. Crie um arquivo .env na raiz do projeto e configure as variáveis de ambiente necessárias, como acesso ao banco de dados e informações de autenticação.
5. Execute o comando php artisan key:generate para gerar a chave de criptografia do Laravel.
6. Execute o comando php artisan migrate para criar as tabelas do banco de dados.
7. Execute o comando php artisan serve para iniciar o servidor local.
8. Acesse a aplicação em seu navegador utilizando o endereço http://localhost:8000 (ou outro endereço e porta definidos pelo servidor local do Laravel).

## Modelo Entidade e Relacionamento e Passos tomados para Elaboração do sistema

<p float="left">

 ![ModeloER.PNG](/public/img/ModeloER.PNG)

 ![Passosdoprojeto.PNG](/public/img/Passosdoprojeto.PNG)

</p>

## Execute o seguinte comando para clonar o repositório:

git clone https://git.vibbra.com.br/jean-1685398334/controle_nf.git

Navegue até o diretório do projeto:

cd controle_nf
Instale as dependências do projeto:

composer install
Configure o arquivo .env com as informações do banco de dados e outras configurações necessárias.

Execute o seguinte comando para gerar a chave de criptografia:

php artisan key:generate

Execute as migrações do banco de dados:

php artisan migrate

Execute o server:

php artisan serve

Acesse o sistema no seu navegador:

http://localhost:8000


## Licença

Este projeto está licenciado sob a [Licença MIT](https://opensource.org/licenses/MIT) - consulte o arquivo [LICENSE](LICENSE) para obter mais detalhes.


## Contato

Jean Abreu - jeandcabreu@gmail.com

