<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

/**
 * 
 * Ambil semua produk
 * 
 * Endpoint ini mengembalikan seluruh data produk yang tersedia.
 */

//get products
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    /**
     * 
     * Ambil produk berdasarkan ID
     * 
     * Endpoint ini mengembalikan data produk berdasarkan ID yang diberikan.
     */
    
    //get /products/{id}
    public function show($id){
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }


    /**
     * 
     * Tambah produk baru
     * 
     * Endpoint ini memungkinkan penambahan produk baru ke dalam sistem.
     */

    //post /products
    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric'
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Product berhasil ditambahkan',
            'data' => $product
        ]);
    }


    /**
     * 
     * Update produk
     * 
     * Endpoint ini memungkinkan pembaruan data produk yang sudah ada.
     */

    //put /products/{id}
    public function update(Request $request, $id){

        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product tidak ditemukan'
            ], 404);
        }
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric'
        ]);

        $product->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Product berhasil diupdate',
            'data' => $product
        ]);
    }

    /**
     * 
     * Hapus produk
     * 
     * Endpoint ini memungkinkan penghapusan produk dari sistem.
     */

    //delete /products/{id}
    public function destroy($id){

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product berhasil dihapus'
        ]);
    }

}