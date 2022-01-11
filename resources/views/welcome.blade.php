@extends('layouts.app')

@section('content')
    <x-inputs.cnpj wire:model="teste"/>
    <x-inputs.cnpj-cpf wire:model="teste"></x-inputs.cnpj-cpf>
    <x-inputs.cpf wire:model="teste"></x-inputs.cpf>
    <x-inputs.date wire:model="teste"></x-inputs.date>
    <x-inputs.email wire:model="teste"></x-inputs.email>
    <x-inputs.password wire:model="teste"></x-inputs.password>
    <x-inputs.phone wire:model="teste"></x-inputs.phone>
    <x-inputs.text wire:model="teste"></x-inputs.text>
    <x-inputs.tom-select wire:model="teste"> label="teste"></x-inputs.tom-select>
@endsection
