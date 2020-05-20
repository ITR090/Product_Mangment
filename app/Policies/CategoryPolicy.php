<?php

namespace App\Policies;

use App\User;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */



    // public function before(User $User)
    // {
    //     if ($User->isAdmin ==1) {
    //         return true;
    //     }
    // }

    // اذا صار ادمن شامل يقدر يدعو الناس لاي قسم حتئ لو ما ملكه
    public function viewAny(User $User)
    {
        if($User->isAdmin == 1){
            return true;
        }
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\User  $user
     * @param  \App\Category  Category
     * @return mixed
     */

    //  هل اليوزر يملك قسم او لا
    public function view(User $User)
    {
       if($User->OwnerCategories->isNotEmpty()){
           return true;
       }
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $User)
    {
        //
    }

    /**
     * Determine whether the user can update the  category.
     *
     * @param  \App\User  $user
     * @param  \App\odle=Category  $odle=Category
     * @return mixed
     */
    public function update(User $User, Category $Category)
    {
        return $User->id === $Category->user_id;
    }

    /**
     * Determine whether the user can delete the odle= category.
     *
     * @param  \App\User  $user
     * @param  \App\odle=Category  $odle=Category
     * @return mixed
     */
    public function delete(User $User, Category $Category)
    {
        return $User->id === $Category->user_id;
    }

    /**
     * Determine whether the user can restore the odle= category.
     *
     * @param  \App\User  $user
     * @param  \App\odle=Category  $odle=Category
     * @return mixed
     */
    public function restore(User $User, Category $Category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the odle= category.
     *
     * @param  \App\User  $user
     * @param  \App\odle=Category  $odle=Category
     * @return mixed
     */
    public function forceDelete(User $User, Category $Category)
    {
        //
    }
}
