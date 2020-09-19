@extends('layouts.app')

@section('content')
    <h1>Items Management Page</h1>

    <div class="row mt-5">
        <div class="col-md-5 col-sm-12">
            <section class="add-item-form">
                <form id="addItemForm" class="d-flex form-inline">
                    <div class="form-group w-75">
                        <input type="text" class="form-control w-100" name="item_name" id="itemName" placeholder="Enter item name and click add item">
                    </div>
                    <button type="submit" class="btn btn-primary ml-2">Add Item</button>
                </form>
            </section>

            <section class="items-list border p-3 w-50 mt-4" id="unselected-items-section">
                <ul class="list-unstyled">
                    @foreach($items->where('is_selected', false) as $item)
                        <li class="py-2 px-4 unselected-list-item clickable" data-id="{{ $item->id }}">{{ $item->name }}</li>
                    @endforeach
                </ul>
            </section>
        </div>
        <div class="col-md-2 col-sm-12 align-self-center ">
            <div class="arrow-items items-center">
                <button class="btn btn-primary btn-block w-25 move-selected-list-btn" disabled> > </button>
                <button class="btn btn-primary btn-block w-25 move-unselected-list-btn" disabled> < </button>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <h3>Selected Items : </h3>

            <section class="selected-items-list border p-3 w-50 mt-4" id="selected-items-section">
                <ul class="list-unstyled">
                    @foreach($items->where('is_selected', true) as $item)
                        <li class="py-2 px-4 selected-list-item clickable" data-id="{{ $item->id }}">{{ $item->name }}</li>
                    @endforeach
                </ul>
            </section>
        </div>

    </div>

@stop
