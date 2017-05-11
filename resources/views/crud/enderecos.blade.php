@extends ('crud.master')

@section('title', 'Endereços')

@section('content')

   <div class="container-fluid" style="background-color: white;">
    <h3>enderecos</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>ID Usuario</th>
            <th>Identificação</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th></th>
        </tr>
        @foreach($enderecos as $endereco)
        <tr>
            <td>{{ $endereco->id }}</td>
            <td>{{ $endereco->id_usuario }}</td>
            <td>{{ $endereco->identificacao }}</td>
            <td>{{ $endereco->estado }}</td>
            <td>{{ $endereco->cidade }}</td>
            <td>{{ $endereco->bairro }}</td>
            <td>
                <input type="hidden" name="id_endereco" value="{{ $endereco->id }}">
                <button class="btn btn-success" type="button"
                    data-toggle="modal" data-target="#modalEditar" onclick="id = {{ $endereco->id }}; 
                    getById(editId);">
                    Editar
                </button>

                <button class="btn btn-danger" type="button"
                data-toggle="modal" data-target="#modalDeletar" onclick="id = {{ $endereco->id }}">
                    Excluir
                </button>
            </td>
        </tr>
        @endforeach

    </table>
    @section('modal-cadastrar')
        <form id="form-cadastrar" class="form-crud" method="POST" action="create-endereco">
            
            <input type="hidden" name="edId">

            <div class="form-group">
                <select name="id_usuario" class="form-control" required>
                    <option selected hidden value="">Usuario</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="identificacao"
                 placeholder="Identificação do seu endereço, Ex: Casa, Trabalho" required>
            </div>
            <div class="form-group">
                <select name="estado" id="estados" class="form-control" required>
                </select>
            </div>
            <div class="form-group">
                <select name="cidade" id="cidades" class="form-control" required>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="bairro" placeholder="Bairro" required>
            </div>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form id="form-editar" class="form-crud" method="POST" action="edit-endereco">
            
            <input type="hidden" id="edId" name="id">
            
            <div class="form-group">
                <select name="id_usuario" class="form-control" required>
                    <option selected hidden value="">Usuario</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <input type="text" id="edIdentificacao" class="form-control" name="identificacao"
                 placeholder="Identificação do seu endereço, Ex: Casa, Trabalho" required>
            </div>
            <div class="form-group">
                <select name="estado" id="edEstados" class="form-control" required>
                </select>
            </div>
            <div class="form-group">
                <select name="cidade" id="edCidades" class="form-control" required>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="edBairro" class="form-control" name="bairro" placeholder="Bairro" required>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btn_editar" type="submit" class="btn btn-success">Editar</button>
            
        </form>
    @endsection

    @section('modal-deletar')
        <h4>Você tem certeza que deseja excluir esse registro?</h4>
        <h5>Essa ação é irreversível</h5>
    @endsection
        
</div> <!--CONTAINER-->
@endsection

@section('scripts')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" async integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    var deleteId = null;
    var editId = null;

    $(document).ready(function(){
        var id = this.id;

         $.getJSON('js/dados/estados-cidades.json', function (data) {
				var items = [];
                var options = '<option selected value="" hidden>Estado</option>';
				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#estados, #edEstados").html(options);				
				
				$("#estados, #edEstados").change(function () {				
				
                    var options_cidades = '';
					var str = "";					
					
					$("#estados option:selected, #edEstados option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.cidades, function (key_city, val_city) {
								options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});
					$("#cidades, #edCidades").html(options_cidades);
				}).change();	
			});
        
        $('#form-editar').on('submit', function(event){
            var endereco = $('#form-editar').serialize();
            $.ajax({
                type: 'PUT',
                url: 'edit-endereco/'+editId,
                data: endereco,
                success: function(response){
                    console.log(response);
                    console.log(endereco);

                    setTimeout(location.reload(), 200);
                },
                error: function (response){
                    console.log("ERROR");
                    console.log(response);
                    console.log(endereco);
                }
            });
            event.preventDefault();
        });

        $('#btn_delete').on('click', function(event){
            $.ajax({
                type: "DELETE",
                url: 'delete-endereco/'+deleteId,
                success: function(response){
                    console.log("SUCESSO");
                    console.log(response);

                    setTimeout(location.reload(), 200);
                },
                error: function(response){
                    console.log("ERRO");
                    console.log(response);
                }
            });
        });
    });

    function clearEditText()
    {
        document.querySelector('#edIdentificacao').value = null;
        document.querySelector('#edEstado').value = null;
        document.querySelector('#edCidade').value = null;
        document.querySelector('#edBairro').value = null;
    }

    function getById(id)
    {
        clearEditText();
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if(xhttp.readyState == 4 && xhttp.status == 200) {
                var dados = JSON.parse(xhttp.responseText);
                document.querySelector('#edIdentificacao').value = dados.identificacao;
                document.querySelector('#edEstado').value = dados.estado;
                document.querySelector('#edCidade').value = dados.cidade;
                document.querySelector('#edBairro').value = dados.bairro;
                document.querySelector('#edId').value = id;
                console.log(dados);
            }
            else {
                console.log("Resposta ainda não chegou ou houve um erro");
            }
        }
        xhttp.open('get', 'get-endereco/'+id, true);
        xhttp.send();    
    }
</script>
@endsection