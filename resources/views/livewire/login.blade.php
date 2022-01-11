<div>
    <x-inputs.text label="Nome" placeholder="Nome" wire:model.defer="name" required/>
    <input type="text" wire:model="login">
    @error('login') <span class="error">{{ $message }}</span> @enderror
    <input type="password" wire:model="password">
    <button wire:click="logar">Clicar</button>
</div>
