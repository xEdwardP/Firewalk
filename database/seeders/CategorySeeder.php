<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Abarrotes', 'description' => 'Productos básicos como arroz, frijoles y pastas.'],
            ['name' => 'Lácteos y Huevos', 'description' => 'Leche, queso, yogur y huevos frescos.'],
            ['name' => 'Bebidas', 'description' => 'Jugos, refrescos, aguas y bebidas energéticas.'],
            ['name' => 'Snacks y Dulces', 'description' => 'Golosinas, papas fritas y chocolates.'],
            ['name' => 'Higiene Personal', 'description' => 'Shampoo, jabón, pasta dental y desodorantes.'],
            ['name' => 'Limpieza del Hogar', 'description' => 'Detergentes, cloro, escobas y limpiadores.'],
            ['name' => 'Panadería y Tortillas', 'description' => 'Pan fresco, bollería y tortillas de maíz.'],
            ['name' => 'Frutas y Verduras', 'description' => 'Productos frescos como tomates, plátanos y lechuga.'],
            ['name' => 'Carnes y Embutidos', 'description' => 'Pollo, res, cerdo y embutidos variados.'],
            ['name' => 'Artículos de Uso Diario', 'description' => 'Pilas, fósforos, bolsas y papel higiénico.'],

            ['name' => 'Electrónica', 'description' => 'Accesorios tecnológicos como cables, cargadores y audífonos.'],
            ['name' => 'Papelería', 'description' => 'Cuadernos, lápices, marcadores y carpetas.'],
            ['name' => 'Mascotas', 'description' => 'Alimentos, juguetes y productos de higiene para mascotas.'],
            ['name' => 'Ropa y Calzado', 'description' => 'Prendas básicas y zapatos para toda la familia.'],
            ['name' => 'Juguetería', 'description' => 'Juguetes educativos, peluches y juegos de mesa.'],
            ['name' => 'Ferretería', 'description' => 'Herramientas, tornillos, pinturas y materiales de construcción.'],
            ['name' => 'Belleza y Cosméticos', 'description' => 'Maquillaje, cremas y productos para el cuidado personal.'],
            ['name' => 'Salud y Medicamentos', 'description' => 'Productos farmacéuticos y suplementos.'],
            ['name' => 'Electrodomésticos', 'description' => 'Pequeños aparatos como licuadoras y planchas.'],
            ['name' => 'Decoración', 'description' => 'Cuadros, floreros y artículos decorativos para el hogar.'],
            ['name' => 'Automotriz', 'description' => 'Aceites, accesorios y productos para vehículos.'],
            ['name' => 'Camping y Aire Libre', 'description' => 'Tiendas, mochilas y artículos para excursiones.'],
            ['name' => 'Deportes', 'description' => 'Balones, ropa deportiva y suplementos.'],
            ['name' => 'Tecnología', 'description' => 'Dispositivos móviles, tablets y accesorios.'],
            ['name' => 'Oficina', 'description' => 'Sillas, escritorios y suministros para el trabajo.'],
            ['name' => 'Jardinería', 'description' => 'Macetas, tierra, semillas y herramientas.'],
            ['name' => 'Bebés y Maternidad', 'description' => 'Pañales, biberones y productos para recién nacidos.'],
            ['name' => 'Libros y Revistas', 'description' => 'Literatura, revistas y material educativo.'],
            ['name' => 'Seguridad', 'description' => 'Candados, cámaras y alarmas para el hogar.'],
            ['name' => 'Viajes y Maletas', 'description' => 'Maletas, mochilas y accesorios para viajeros.']
        ];

        foreach ($categories as $data) {
            Category::create([
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        }
    }
}
