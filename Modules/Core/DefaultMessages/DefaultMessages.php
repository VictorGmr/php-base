<?php

namespace Modules\Core\DefaultMessages;

use MyCLabs\Enum\Enum;

final class DefaultMessages extends Enum
{
    const CADASTRADO_COM_SUCESSO            =   'cadastrado com sucesso';
    const CADASTRADA_COM_SUCESSO            =   'cadastrada com sucesso';
    const ERROR_AO_CADASTRAR                =   'erro ao cadastrar';

    const EDITADO_COM_SUCESSO               =   'editado com sucesso';
    const EDITADA_COM_SUCESSO               =   'editada com sucesso';
    const ERROR_AO_EDITAR                   =   'erro ao editar';

    const HABILITADO_COM_SUCESSO            =   'ativado com sucesso';
    const HABILITADA_COM_SUCESSO            =   'ativada com sucesso';
    const ERROR_AO_HABILITAR                =   'erro ao habilitar';

    const DESABILITADO_COM_SUCESSO          =   'desativado com sucesso';
    const DESABILITADA_COM_SUCESSO          =   'desativada com sucesso';
    const ERROR_AO_DESABILITAR              =   'erro ao desabilitar';

    const DELETADO_COM_SUCESSO              =   'deletado com sucesso';
    const DELETADA_COM_SUCESSO              =   'deletada com sucesso';
    const DELETADOS_COM_SUCESSO             =   'deletados com sucesso';
    const DELETADAS_COM_SUCESSO             =   'deletadas com sucesso';
    const ERROR_AO_DELETAR                  =   'erro ao deletar';

    const ERROR_AO_BUSCAR                   =   'erro ao buscar';
    const ELEMENTO_NAO_ENCONTRADO           =   'não foi possível encontrar';

    const DOMINIO_NAO_ENCONTRADO            =   'houve um erro desconhecido';
    const MENSAGEM_DE_ERRO_NAO_CONTRADA     =   'houve um erro desconhecido';

    const TEM_CERTEZA_EM_HABILITAR_O        =   'Você realmente deseja <span class="$STYLE$ font-bold">$STATUS$</span> o';
    const TEM_CERTEZA_EM_HABILITAR_A        =   'Você realmente deseja <span class="$STYLE$ font-bold">$STATUS$</span> a';

    const TEM_CERTEZA_EM_DESABILITAR_O      =   'Tem certeza em desabilitar o';
    const TEM_CERTEZA_EM_DESABILITAR_A      =   'Tem certeza em desabilitar a';

    const VOCE_REALMENTE_DESEJA_DELETAR_O   =   'Você realmente deseja deletar o';
    const VOCE_REALMENTE_DESEJA_DELETAR_A   =   'Você realmente deseja deletar a';
    const VOCE_REALMENTE_DESEJA_DELETAR     =   'Você realmente deseja deletar <b>$QTD$</b>';

    /**
     * Packages
     */
    const DOMAINS_MESSAGES_MALE = [
        GlobalMessages::CREATE_SUCCESS => DefaultMessages::CADASTRADO_COM_SUCESSO,
        GlobalMessages::CREATE_ERROR => DefaultMessages::ERROR_AO_CADASTRAR,
        GlobalMessages::EDIT_SUCCESS => DefaultMessages::EDITADO_COM_SUCESSO,
        GlobalMessages::EDIT_ERROR => DefaultMessages::ERROR_AO_EDITAR,
        GlobalMessages::ENABLE_SUCCESS => DefaultMessages::HABILITADO_COM_SUCESSO,
        GlobalMessages::ENABLE_ERROR => DefaultMessages::ERROR_AO_HABILITAR,
        GlobalMessages::DISABLE_SUCCESS => DefaultMessages::DESABILITADO_COM_SUCESSO,
        GlobalMessages::DISABLE_ERROR => DefaultMessages::ERROR_AO_DESABILITAR,
        GlobalMessages::DELETE_SUCCESS => DefaultMessages::DELETADO_COM_SUCESSO,
        GlobalMessages::DELETE_SUCCESS_ALL => DefaultMessages::DELETADOS_COM_SUCESSO,
        GlobalMessages::DELETE_ERROR => DefaultMessages::ERROR_AO_DELETAR,
        GlobalMessages::SEARCH_ERROR => DefaultMessages::ERROR_AO_BUSCAR,
        GlobalMessages::ELEMENT_NOT_FOUND => DefaultMessages::ELEMENTO_NAO_ENCONTRADO,
        GlobalMessages::CONFIRM_ENABLE => DefaultMessages::TEM_CERTEZA_EM_HABILITAR_O,
        GlobalMessages::CONFIRM_DISABLE => DefaultMessages::TEM_CERTEZA_EM_DESABILITAR_O,
        GlobalMessages::CONFIRM_DELETE => DefaultMessages::VOCE_REALMENTE_DESEJA_DELETAR_O,
        GlobalMessages::CONFIRM_DELETE_ALL => DefaultMessages::VOCE_REALMENTE_DESEJA_DELETAR,
    ];

    const DOMAINS_MESSAGES_FEMALE = [
        GlobalMessages::CREATE_SUCCESS => DefaultMessages::CADASTRADA_COM_SUCESSO,
        GlobalMessages::CREATE_ERROR => DefaultMessages::ERROR_AO_CADASTRAR,
        GlobalMessages::EDIT_SUCCESS => DefaultMessages::EDITADA_COM_SUCESSO,
        GlobalMessages::EDIT_ERROR => DefaultMessages::ERROR_AO_EDITAR,
        GlobalMessages::ENABLE_SUCCESS => DefaultMessages::HABILITADA_COM_SUCESSO,
        GlobalMessages::ENABLE_ERROR => DefaultMessages::ERROR_AO_HABILITAR,
        GlobalMessages::DISABLE_SUCCESS => DefaultMessages::DESABILITADA_COM_SUCESSO,
        GlobalMessages::DISABLE_ERROR => DefaultMessages::ERROR_AO_DESABILITAR,
        GlobalMessages::DELETE_SUCCESS => DefaultMessages::DELETADA_COM_SUCESSO,
        GlobalMessages::DELETE_SUCCESS_ALL => DefaultMessages::DELETADAS_COM_SUCESSO,
        GlobalMessages::DELETE_ERROR => DefaultMessages::ERROR_AO_DELETAR,
        GlobalMessages::SEARCH_ERROR => DefaultMessages::ERROR_AO_BUSCAR,
        GlobalMessages::ELEMENT_NOT_FOUND => DefaultMessages::ELEMENTO_NAO_ENCONTRADO,
        GlobalMessages::CONFIRM_ENABLE => DefaultMessages::TEM_CERTEZA_EM_HABILITAR_A,
        GlobalMessages::CONFIRM_DISABLE => DefaultMessages::TEM_CERTEZA_EM_DESABILITAR_A,
        GlobalMessages::CONFIRM_DELETE => DefaultMessages::VOCE_REALMENTE_DESEJA_DELETAR_A,
        GlobalMessages::CONFIRM_DELETE_ALL => DefaultMessages::VOCE_REALMENTE_DESEJA_DELETAR,
    ];
}
