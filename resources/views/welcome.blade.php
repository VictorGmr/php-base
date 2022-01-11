@extends('layouts.app')

@section('content')
    <x-inputs.tom-select wire:model="teste" :options="[['id' => '1','name' => 'mundo']]"> label="teste"></x-inputs.tom-select>
    <x-inputs.datepicker wire:model="teste" />
    <x-inputs.cnpj wire:model="teste"/>
    <x-inputs.cnpj-cpf wire:model="teste" />
    <x-inputs.cpf wire:model="teste" />
    <x-inputs.date wire:model="teste" />
    <x-inputs.email wire:model="teste" />
    <x-inputs.password wire:model="teste" />
    <x-inputs.phone wire:model="teste" />
    <x-inputs.text wire:model="teste" />

@endsection
