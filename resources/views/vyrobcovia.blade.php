@extends("layouts.master")
@section('obsah')
@auth
<div class="container" style="min-height: calc(100vh - 132px);">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-dark table-striped table-hover mt-3" style="width:100%">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Krajina</th>
                    <th scope="col">Názov</th>
                    <th scope="col">Úpravy</th>
                    </tr>
                </thead>
                <tbody id="manufacturer-tbody">
                @foreach ($manufacturers as $manufacturer)
                <tr>
                    <td>{{$manufacturer->id}}</td>
                    <td id="{{$manufacturer->id}}-form" style="display: none">
                        <form method="post" id="{{$manufacturer->id}}-manufacturer-edit-form" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <input class="form-control mb-1" id="{{$manufacturer->id}}-country_id_input" name="manufacturer_edit_country_id" type="number" placeholder="Krajina" min="0" step="1" max="9999" required>
                                </div>                              
                        </form>
                    </td>
                    <td id="{{$manufacturer->id}}-form1" style="display: none">
                        <div class="form-group">
                            <input class="form-control mb-1" form="{{$manufacturer->id}}-manufacturer-edit-form" id="{{$manufacturer->id}}-name_input" name="manufacturer_edit_name" type="text" placeholder="Názov" maxlength="50" required
                                    oninvalid="setCustomValidity('Zadajte platný názov. Názov môže obsahovať len písmená, čísla a &quot; -_&quot; .')"oninput="setCustomValidity('')" >
                        </div>
                    </td>
                    <td id="{{$manufacturer->id}}-country" class="manu-country-input" data-manufactureredit='{{$manufacturer->id}}'>{{$manufacturer->country_id}}, {{$manufacturer->country->name}}</td>
                    <td id="{{$manufacturer->id}}-name" class="manu-name-input">{{$manufacturer->name}}</td>
                    <td>
                        <a id="{{$manufacturer->id}}-x" class="manu-close-btn" style="color: inherit;text-decoration: none;display: none;" data-manufactureredit='{{$manufacturer->id}}'>
                            <button type="button" class="bg-danger text-white">
                                <i class="bi bi-x"></i>
                            </button>
                        </a>    
                        <a  style="color: inherit;text-decoration: none;" data-manufactureredit='{{$manufacturer->id}}'>
                            <button type="submit" id="{{$manufacturer->id}}-check" name="manufacturer-edit" form="{{$manufacturer->id}}-manufacturer-edit-form" style="display: none;"  class="bg-success text-white" data-manufactureredit='{{$manufacturer->id}}'>
                                <i class="bi bi-check"></i>
                            </button>
                        </a>
                        <a style="color: inherit;text-decoration: none;" id="{{$manufacturer->id}}">
                            <button type="button" class="bg-danger text-white delete-manufacturer-btn" data-bs-toggle="modal" data-bs-target="#delete-manufacturer-modal" data-manufacturerdelete='{{$manufacturer->id}}'>
                                <i class="bi bi-trash"></i>
                            </button>
                        </a>
                        <a id="{{$manufacturer->id}}-update" class="manu-edit-btn" data-manufactureredit='{{$manufacturer->id}}' data-url='{{route("updateManufacturer",0)}}'>
                            <button type="button" class="bg-warning text-black "
                            data-url='{{route("updateManufacturer",0)}}'>
                                <i class="bi bi-pen"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
                <tr id="manufacturer-new-tr">
                    <td colspan={{$manufacturers->first()->count()}}>
                        <button action="#" type="button" id="manufacturer-new-button" class="btn btn-primary d-flex align-items-center justify-content-center" style="width: 100%;height: 100%">
                            <i class="bi bi-plus d-flex align-items-center"></i>
                        </button> 
                    </td>
                </tr>
                <tr id="manufacturer-new-tr-edit" style="display: none"><td>--</td>
                    <td>
                        <form method="post" id="manu-edit-form" action="{{route("createManufacturer")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input class="form-control mb-1" name="country_id" id="country_id" type="number" placeholder="Krajina" min="0" step="1" max="9999" required>
                            </div>                              
                        </form>
                    </td>
                    <td>
                        <div class="form-group">
                            <input class="form-control mb-1" form="manu-edit-form" id="name" name="name" type="text" placeholder="Názov" maxlength="50" required
                            oninvalid="setCustomValidity('Zadajte platný názov. Názov môže obsahovať len písmená, čísla a &quot; -_&quot; .')"
                            oninput="setCustomValidity('')" >
                        </div>
                    </td>
                    <td>    
                        <a id="manufacturer-close-new" style="color: inherit;text-decoration: none;">
                            <button type="button" class="bg-danger text-white">
                                <i class="bi bi-x"></i>
                            </button>
                        </a>
                        <a style="color: inherit;text-decoration: none;">
                        <button type="submit" id="submit" name="manufacturer-submit" form="manu-edit-form"  class="bg-success text-white">
                            <i class="bi bi-check"></i>
                        </button>
                    </a>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endauth
@include('modal.delete-manufacturer')
@endsection
@section('pagespecificscripts')
<script type="text/javascript">

    var frm = $('#manu-edit-form');
    frm.submit(function (e) {
        e.preventDefault();
        console.log(frm.serialize());
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),

            success: function (data) {
                var html = '<tr>';
     html += '<td>'+data.country_id+'</td>';
     html += '<td>'+data.name+'</td></tr>';
     $('#manufacturer-tbody').prepend(html);
     $('#manu-edit-form')[0].reset();
                console.log('Submission was successful.');
                console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    });
</script>
    <script src="{{ asset('js/manufacturer/edit-manufacturer.js') }}"></script>
@stop