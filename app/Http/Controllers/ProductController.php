<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): string
    {
        return view('products.index');
    }

    public function create(): string
    {
        return 'Este es el form para crear productos from CONTROLLER';
    }

    public function store()
    {

    }

    public function show($product): string
    {
        return view('products.show');
    }

    public function edit($product): string
    {
        return "Un form para editar el producto $product From CONTROLLER" ;
    }

    public function update($product): string
    {
        return "Un form para updater el producto $product From CONTROLLER" ;
    }

    public function destroy($product): string
    {
        return "Un form para destroyer el producto $product From CONTROLLER" ;
    }
}
