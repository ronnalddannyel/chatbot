<x-layout-dashboard title="Auto Replies">
  
    <div class="app-content">
        {{-- <link href="{{asset('plugins/datatables/datatables.min.css')}}" rel="stylesheet"> --}}
        {{-- <link href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet"> --}}
        <link href="{{asset('css/custom.css')}}" rel="stylesheet">
        <div class="content-wrapper">
            <div class="container">
                @if (session()->has('alert'))
                <x-alert>
                    @slot('type',session('alert')['type'])
                    @slot('msg',session('alert')['msg'])
                </x-alert>
             @endif
             @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
       
           
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                 
                                <h5 class="card-title">Lista de Auto-Respostas {{Session::get('selectedDevice')}} </h5>
                                <div class="d-flex ">
                                   
                                    @if(Session::has('selectedDevice'))

                                   
                                    <form action="{{route('deleteAllAutoreply')}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" name="delete" class="btn btn-danger btn-xs"><i class="material-icons">delete_outline</i>Deletar Todas</button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-xs mx-4" data-bs-toggle="modal" data-bs-target="#addAutoRespond"><i class="material-icons-outlined">add</i>Add</button>
                                    @endif
                                </div>
                                 </div>
                            <div class="card-body rounded-lg">
                                <table id="datatable1" class="display table table-striped table-bordered" style="width:100%">
                                    {{-- if exist autoreplies variable foreach, else please select device --}}
                                  
                                     <thead class="">
                                        <tr>
                                           
                                            <th>Palavra-Chave</th>
                                           <th>Tipo</th>
                                            <th>Resposta</th>
                                            <th>A????o</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                     

                                        @if(Session::has('selectedDevice'))
                                       @foreach ($autoreplies as $autoreply)

                                       <tr>
    
                                       
                                        <td>{{$autoreply['keyword']}} </td>
                                        <td>{{$autoreply['type']}}</td>
                                       <td><button class="btn btn-primary" onclick="viewReply({{$autoreply->id}})">View</button></td>
                                        <td> 
                                            <form action={{route('autoreply.delete')}} method="POST">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="id" value="{{$autoreply->id}}">
                                                <button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="material-icons">delete_outline</i></button>
                                            </form>

                                        </td>
                                    </tr>
                                       @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">Por favor, selecione o Whatsapp</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                   
                                 
    
                                </table>
                                {{-- pagination custom --}}
                                
                                <div class="d-flex">
                                    {{$autoreplies->links()}}
                                </div>
                               
                            </div>
                        </div>
                    </div>
    
                </div>
    
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="addAutoRespond" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="formautoreply">
                    @csrf
                    <label for="device" class="form-label">N.?? Whatsapp</label>
                   @if(Session::has('selectedDevice'))
                    <input type="text" name="device" id="device" class="form-control" value="{{Session::get('selectedDevice')}}" readonly>
                    @else
                    <input type="text" name="devicee" id="device" class="form-control" value="Please select device" readonly>
                    @endif
                    <label for="keyword" class="form-label">Palavra-Chave</label>
                    <input type="text" name="keyword" class="form-control" id="keyword" required>
                    <label for="type" class="form-label">Tipo de Resposta</label>
                    <select name="type" id="type" class="js-states form-control" tabindex="-1" required>
                      <option selected  disabled>Selecione uma</option>
                        <option value="text">Mensagem de Texto</option>
                        <option value="image">Mensagem com Imagem</option>
                        <option value="button">Mensagem com Bot??es</option>
                        <option value="template">Template de Mensagem</option>
                        <option value="list">Lista de Mensagens</option>
                       
                     </select>
                     <div class="ajaxplace"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pr??-Visaliza????o</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body showReply">
                 </div>
        </div>
    </div>
</div>
<!--  -->
    {{-- <script src="{{asset('js/pages/datatables.js')}}"></script> --}}
    {{-- <script src="{{asset('js/pages/select2.js')}}"></script> --}}
    <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
    {{-- <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script> --}}
  <script src="{{asset('js/autoreply.js')}}"></script>
 
</x-layout-dashboard>