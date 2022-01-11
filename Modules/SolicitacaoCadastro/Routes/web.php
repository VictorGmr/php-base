<?php
Route::prefix('solicitacao-cadastro')->group(function() {
    Route::get('/', 'SolicitacaoCadastroController@index');
});
