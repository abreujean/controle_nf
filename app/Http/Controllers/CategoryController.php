<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{

    public static $ACTIVE = 1;
     /**
     * Function to register new Category
     * @param 
     * @return object
     */
    public function newCategory($category, $description): object
    {
        $category = Category::create([
            'category' => $category,
            'description' => $description,
            'active' => CategoryController::$ACTIVE,
            'codhash' => Uuid::uuid4(),
        ]);

        return $category;
    }


    /**
     * Function to check there is registration of category
     * @param placa
     * @return boolean
     */
    public function validateIfCategoryIsRegistered($category): bool
    {
        $category = Category::where('category', $category)->get();
        return isset($category[0]->category) ? true : false;
    }

    /**
     * Function to list category in system
     * @return JsonResponse
     */
    public function listAllCategory(): object
    {
        $category = Category::all();
        return $category;
    }


     /**
     * Function to list category in system
     * @return JsonResponse
     */
    public function listActiveCategory(): object
    {
        $category = Category::where('active', CategoryController::$ACTIVE);
        return $category;
    }


    /**
     * Function to retrieve category id by codhash
     * @param placa
     * @return boolean
     */
    public function recoverIDByCodHashCategory($codhash): int
    {
        $category = Category::where('codhash', $codhash)->get();
        return $category[0]->id;
    }


    /**
     * Função para excluir category
     * @param $id
     * @return void
     */
    public function deleteCategory($id) : void {
        Category::where(['id' => $id])->delete();
    }


    /**
     * Function to retrieve category data.
     * @param $codhash
     * @return object
     */
    public function recoverCategoryDataByCodhash($codhash) : object
    {
        $category = Category::where('codhash', $codhash)->get();
        return $category;
    }


    /**
     * Function to validate if category belongs to another category.
     * @param $category
     * @param $codhash
     */
    public function validateIfCategorybelongsToAnotherCategory($category, $codhash) : bool {
        $value = Category::where('category', $category)->where('codhash', '!=', $codhash)->get();
        return isset($value[0]->category) ? true : false;
    }


    /**
     * Function to update category data.
     */
    public function updateCategory($codhash, $category, $description, $active ) : void
    {
        Category::where('codhash', $codhash)
                ->update(['category' => $category,
                          'description' => $description,
                          'active' => $active,
                        ]);
    }
}
