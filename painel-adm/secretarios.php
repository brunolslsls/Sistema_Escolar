<?php
$pag = "secretarios";
require_once("../conexao.php");
/*
@session_start();
    //verificar se o usuário está autenticado
if(@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Admin'){
    echo "<script language='javascript'> window.location='../index.php' </script>";

}
*/

?>

<div class="row mt-4 mb-4">
    <!-- Criamos Link do tipo botão ,href = mostra o arquivo que vamos acessar apois de clica nesse link -->
    <!--"btn-primary = cor do botão,btn-sm = define que estamos trabalhando com botões pequenos, ml-3 = margem left, -->
    <!-- d-none = esconde o item , d-md-block = tela tem sm(540px) de tamanho  -->
    <!--d-block = item é visivel , d-sm-none = tamanho da tela é xs(0)-->

    <a type="button" class="btn-info btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Secretario</a>
    <a type="button" class="btn-info btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <!--Tabela do dados na pagina -->
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    // fazendo Select do banco
                    $query = $pdo->query("SELECT * FROM secretarios order by id desc "); // intrução do banco de dados
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);  // pega dados de forma de matriz

                    for ($i = 0; $i < count($res); $i++) {   // pecorre as linhas da matriz
                        foreach ($res[$i] as $key => $value) {  // pega dados da matriz e jogando para variavel "res"
                        }
                        // vai passar por toda as linhas da coluna
                        $nome = $res[$i]['nome']; // pegando dados item da coluna "nome"
                        $telefone = $res[$i]['telefone']; // pegando dados item da coluna "telefone"
                        $email = $res[$i]['email']; // pegando dados item da coluna "telefone"
                        $endereco = $res[$i]['endereco']; // pegando dados item da coluna "endereco"
                        $cpf = $res[$i]['cpf']; // pegando dados item da coluna "cpf"
                        $id = $res[$i]['id']; // pegando dados item da coluna "id"
                    ?>
                        <!--Preenchendo a tabela -->
                        <tr>
                            <td><?php echo $nome ?></td>
                            <td><?php echo $telefone ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $cpf ?></td>

                            <td>
                                <!--href = arquivo que vamos acessar // funcao = tipo de função que acionamos // id recebe id daquela pessoa na tabela  -->
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!--final da tabela-->
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                // verificar se clicamos no botão editar ou adicionar
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM secretarios where id = '" . $id2 . "' "); // seleciona os dados ONDE id igual a id2
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);  // cria matriz de dados

                    // isso aqui so vai pegar um usuario por causa do $res[0]
                    $nome2 = $res[0]['nome']; // pega valor da linha Zero e na coluna nome
                    $telefone2 = $res[0]['telefone']; // pega valos da linha Zero e na coluna telefone
                    $email2 = $res[0]['email']; // pega valor da linha Zero e na coluna email
                    $endereco2 = $res[0]['endereco']; // pega valos da linha Zero e na coluna endereco
                    $cpf2 = $res[0]['cpf']; // pega valos da linha Zero e na coluna cpf

                    $id2 = $res[0]['id']; // pega valos da linha Zero e na coluna id

                } else {
                    $titulo = "Inserir Registro";
                }
                ?>

                <!--Titulo da modal-->
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--formulario -->
            <form id="form" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nome</label>
                        <input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label>CPF</label>
                        <input value="<?php echo @$cpf2 ?>" type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input value="<?php echo @$telefone2 ?>" type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input value="<?php echo @$email2 ?>" type="text" class="form-control" id="email" name="email" placeholder="email">
                    </div>

                    <div class="form-group">
                        <label>Endereço</label>
                        <input value="<?php echo @$endereco2 ?>" type="text" class="form-control" id="endereco" name="endereco" placeholder="endereco">
                    </div>

                    <!-- è local de mensagem de alerta para o usuario-->
                    <small>
                        <div id="mensagem">

                        </div>
                    </small>

                </div>


                <!-- RodaPé da-->
                <div class="modal-footer">
                    <!--Podemos criar input que não vai aparecer na modal so para pegar os dados dos valores de alguns campos-->
                    <!--value = Pegamos valor do id // type = input vai ser invisivel  // name e id é oo identifcador -->
                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">

                    <!--value = Pegamos valor do Cpf // type = input vai ser invisivel  // name e id é oo identifcador -->
                    <input value="<?php echo @$cpf2 ?>" type="hidden" name="antigo" id="antigo">

                    <!--value = Pegamos valor do Cpf // type = input vai ser invisivel  // name e id é oo identifcador -->
                    <input value="<?php echo @$email2 ?>" type="hidden" name="antigo2" id="antigo2">

                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
                </div>
            </form>
            <!--Fim do formulario--->
        </div>
    </div>
</div>






<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Registro?</p>

                <div align="center" id="mensagem_excluir" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
// verifica qual botão foi clicado
if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
    echo "<script>$('#modalDados').modal('show');</script>"; // a modal com ID "modalDados" vai abrir
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalDados').modal('show');</script>"; // a modal com ID "modalDados" vai abrir
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-deletar').modal('show');</script>"; // a modal com ID "modal-deletar" vai abrir
}

?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form").submit(function() {
        var pag = "<?= $pag ?>"; // pegando tipo de pagina que estamos
        event.preventDefault();
        var formData = new FormData(this); // FormData = cria um formulario , mas podemos jogar no parametro que adicione todos os campo de um formulario especifico passando id desse formulario

        $.ajax({
            url: pag + "/inserir.php", // envia dados para esse arquivo
            type: 'POST', // tipo de envio dos dados          
            data: formData, // dados que vai ser enviado

            success: function(mensagem) { // mensagem que vai aparece apois receber um echo do arquivo que vai enviar

                $('#mensagem').removeClass() // remove uma classe

                if (mensagem.trim() == "Salvo com Sucesso!") { // trim = limpa os espacos em branco desnecessarios

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag=" + pag; // faz navegador abre essa pagina

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function() { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function() {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-deletar').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!') {


                        $('#btn-cancelar-excluir').click();  // fechando a modal no botão Cancelar
                        window.location = "index.php?pag=" + pag; // atualiza a pagina abrindo  nesse diretorio
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>



<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }
</script>





<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>