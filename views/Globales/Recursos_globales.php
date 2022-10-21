<link rel="stylesheet" href="/cat/SCA/public/node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/cat/SCA/public/node_modules/bootstrap/dist/css/fonts.css">
<script src="/cat/SCA/public/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/cat/SCA/public/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="/cat/SCA/public/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<style type="text/css">
    :root {
        --principal-color: #F3F8FB;
        --color-decorativo: #DADADA;
        --prioridad-alta: #D9EBFF;
        --sub-prioridad-alta: #ECF5FF;
    }

    .color-principal {
        background-color: var(--principal-color);
    }

    .bg-decorativo {
        background-color: var(--color-decorativo);
    }
    .bg-sub-prioridad-alta{
        background-color: var(--sub-prioridad-alta);
    }
    .sombra-secundaria {
        -webkit-box-shadow: 0px 0px 22px 0px rgba(204, 204, 204, 1);
        -moz-box-shadow: 0px 0px 22px 0px rgba(204, 204, 204, 1);
        box-shadow: 0px 0px 22px 0px rgba(204, 204, 204, 1);
    }

    .sombra-principal {
        -webkit-box-shadow: 0px 0px 22px 0px rgb(130 130 130);
        -moz-box-shadow: 0px 0px 22px 0px rgb(130 130 130);
        box-shadow: 0px 0px 22px 0px rgb(130 130 130);

    }

    .redondear {
        border-radius: 22px;
    }
    .redondear-secundario{
        border-radius: 12px;
    }
    .label-inputs {
        font-size: 10pt;
        font-weight: bold;
    }

    .texto-label {
        font-size: 10pt;
    }

    .alto-seleccionable {
        height: 40px;
    }

    /* scroll bar*/
    /* Works on Firefox */
    * {
        scrollbar-width: thin;
    }

    /* Works on Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 5px;
    }

    *::-webkit-scrollbar-track {
        background: white;
    }

    *::-webkit-scrollbar-thumb {
        background-color: var(--color-decorativo);
        border-radius: 20px;
       
    }
</style>