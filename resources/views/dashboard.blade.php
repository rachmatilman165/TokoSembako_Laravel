@extends('layouts.app')

@section('title', 'Dashboard - Toko Sembako Damai')

@section('content')
<div class="container-fluid px-4" style="background-color: #f0f0f0; min-height: 100vh;">
    <!-- <table>
        <thead>
            <tr style="border: #4caf50 1px solid;">
                <th>Kolom 1</th>
                <th>Kolom 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>"aaa"</td>
                <td>"aaa"</td>
            </tr>
        </tbody>
    </table> -->
    <div class="row py-4">
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #d4af37;">
                <div class="card-body">{{ $produkCount }}</div>
                <div class="card-footer text-center">Jumlah Produk</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #4caf50;">
                <div class="card-body">{{ $supplierCount }}</div>
                <div class="card-footer text-center">Jumlah Supplier</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white" style="background-color: #2196f3;">
                <div class="card-body">{{ $konsumenCount }}</div>
                <div class="card-footer text-center">Jumlah Konsumen</div>
            </div>
        </div>
    </div>
</div>
@endsection