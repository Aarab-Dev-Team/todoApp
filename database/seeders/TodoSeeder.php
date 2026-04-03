<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo ; 
use App\Models\User  ; 

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // $user = User::create(
        //     [
        //         'name'=>'abderrahmane' , 
        //         "email"=>"abderrahmane@gmail.com" , 
        //         "password"=>"hello123"   , 
        //     ]  
        // ) ; 


        // $user->todos()->createMany([

        //         [
        //         'title' => 'تعلم لارافل Seeders',
        //         'description' => 'شرح كيفية ملء قاعدة البيانات تلقائياً',
        //         'priority' => 'high',
        //         'status' => 'pending',
        //         'due_date' => now()->addDays(2),
        //     ],
        //     [
        //         'title' => 'تصميم واجهة Burg',
        //         'description' => 'تعديل ألوان صفحة الدخول والتسجيل',
        //         'priority' => 'medium',
        //         'status' => 'completed',
        //         'due_date' => now()->addDays(5),
        //     ],
        //     [
        //         'title' => 'رفع المشروع على GitHub',
        //         'priority' => 'low',
        //         'status' => 'pending',
        //     ],      

        // ]) ; 


        $user = \App\Models\User::factory()->create([
            "email"=>"mouad@gmail.com" , 
            "password"=>"mouad123" , 
        ]) ; 



        \App\Models\Todo::factory()->count(50)->create([
            "user_id"=>$user->id
        ]) ; 



    }
}
