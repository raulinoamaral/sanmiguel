<?php 
class CategoriaTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categoria')->delete();

        Categoria::create(array(
        	'name'         =>  'Carpintería rural',
            'description'  =>   'Sin description'
        	));
        Categoria::create(array(
        	'name' => 'Raciones',
            'description'  =>   'Sin description'
        	));
        Categoria::create(array(
        	'name' => 'Productos para el campo',
            'description'  =>   'Sin description'
        	));
    }

}
?>