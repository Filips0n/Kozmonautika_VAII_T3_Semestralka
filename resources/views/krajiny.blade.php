@extends("layouts.master")
@section('obsah')
@auth
<div class="container" style="min-height: calc(100vh - 132px);">
    <div class="row">
        <div class="col-lg-12">
       <table class="table table-dark table-striped table-hover mt-3" style="width:100%">
        <thead class="thead-light">
         <tr>
          <th>Názov</th>
          <th>Názov agentúry</th>
          <th>Prefix k raketám</th>
          <th>Úpravy</th>
         </tr>
        </thead>
        <tbody>
        
        </tbody>
       </table>
       {{ csrf_field() }}
     </div>
    </div>
   </div>
@endauth
@include('modal.delete-country')
@endsection
@section('pagespecificscripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    fetch_data();
    
    function fetch_data() {
        $.ajax({
            url:"{{route("fetchCountry")}}",
            dataType:"json",
            success:function(data)
            {
                let html = '';

                for(let i=0; i < data.length; i++) {
                    html +='<tr>';
                    html +='<td contenteditable class="column_name" data-column_name="name" data-id="'+data[i].id+'">'+data[i].name+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="agency_name" data-id="'+data[i].id+'">'+data[i].agency_name+'</td>';
                    html += '<td contenteditable class="column_name" data-column_name="prefix_rockets" data-id="'+data[i].id+'">'+data[i].prefix_rockets+'</td>';
                    html += `<td><a id="${data[i].id}" style="color: inherit;text-decoration: none;">
                                <button type="button" class="bg-danger text-white delete-country-btn" data-bs-toggle="modal" data-bs-target="#delete-country-modal" data-countrydelete='${data[i].id}'>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </a></td></tr>`;
                }
                html += '<tr>';
                html += '<td contenteditable id="name"></td>';
                html += '<td contenteditable id="agency_name"></td>';
                html += '<td contenteditable id="prefix_rockets"></td>';
                html += `<td><a style="color: inherit;text-decoration: none;">
                        <button type="submit" id="add" class="bg-success text-white">
                            <i class="bi bi-check"></i>
                        </button>
                    </a></td></tr>`;/**/
                /*html += '<tr>';
                html += `<td>
                        <form method="post" id="country-add-form" action="{{route("createCountry")}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control mb-1" id="add-name-country" name="name" type="text" placeholder="Názov" required>
                                </div>                              
                        </form>
                        </td>`;
                html += `<td>
                            <div class="form-group">
                                    <input id="add-nameagency-country" class="form-control mb-1" name="agency_name" form="country-add-form" type="text" placeholder="Názov agentúry" maxlength="50" required>
                            </div>
                        </td>`;
                html += `<td>
                    <div class="form-group">
                            <input id="add-prefix-country" class="form-control mb-1" name="prefix_rockets" form="country-add-form" type="text" placeholder="Prefix k raketám" maxlength="50" required>
                    </div>
                </td>`;
                html += `<td>
                            <a style="color: inherit;text-decoration: none;">
                                <button type="submit" form="country-add-form"  class="bg-success text-white">
                                    <i class="bi bi-check"></i>
                                </button>
                            </a>
                        </td>`;
                html += '</tr>';*/
                $('tbody').html(html);
                loadButtons();
                loadForm();
            }
        });
        
    }
    
    let _token = $('input[name="_token"]').val();
    
    

    $(document).on('click', '#add', function(){
        let name = $('#name').text();
        let agency_name = $('#agency_name').text();
        let prefix_rockets = $('#prefix_rockets').text();
        if(name != '' && agency_name != '' && prefix_rockets != '') {
            $.ajax({
                url:"{{route("createCountry")}}",
                method:"POST",
                data:{name:name, agency_name:agency_name,prefix_rockets:prefix_rockets, _token:_token},
                success:function(data) {
                    fetch_data();
                }
            });
        }
    });

    $(document).on('blur', '.column_name', function(){
        let column_name = $(this).data("column_name");
        let column_value = $(this).text();
        let id = $(this).data("id");
    
        if(column_value != '') {
            $.ajax({
                url:"{{ route('updateCountry') }}",
                method:"POST",
                data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
                success:function(data){}
            })
        }
    });


    $(document).on('click', '.delete', function(){
        let id = $(this).data("countrydelete");
        $.ajax({
        url:"{{ route('deleteCountry') }}",
        method:"POST",
        data:{id:id, _token:_token},
        success:function(data) {
        fetch_data();
        }
        });
    });

    function loadButtons(){
        const deleteCountryBtns = document.querySelectorAll(".delete-country-btn");
        const buttonDeleteCountry = document.getElementById("button-delete-country");
        for(let i = 0; i < deleteCountryBtns.length; i++){
            const countryDeleteData = deleteCountryBtns[i].dataset.countrydelete;
            deleteCountryBtns[i].addEventListener("click", ()=>{
                buttonDeleteCountry.dataset.countrydelete = countryDeleteData;
            });
        }
    }

    function loadForm(){
        let _token = $('input[name="_token"]').val();
        var frm = $('#country-add-form');
        frm.submit(function (e) {
            e.preventDefault();
            console.log(frm.serialize());
            var name = $("#name").val();
      var agency_name = $("#agency_name").val();
      var prefix_rockets = $("#prefix_rockets").val();
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                /*data: frm.serialize(),*/
                data:{name:name, agency_name:agency_name,prefix_rockets:prefix_rockets, _token:_token}, 
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#country-add-form')[0].reset();
                    console.log('Submission was successful.');
                    console.log(data);
                    fetch_data();
                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
        });
    }
});
</script>

@stop