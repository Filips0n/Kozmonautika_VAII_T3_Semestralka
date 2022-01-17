@extends("layouts.master")
@section('obsah')
@auth
<div class="container" style="min-height: calc(100vh - 132px);">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-dark table-striped table-hover mt-3" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
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

                for(let i = 0; i < data.length; i++) {
                    html +='<tr>';
                    html +=`<td>${data[i].id}</td>`;
                    html +=`<td contenteditable class="column_name" data-column_name="name" data-id="${data[i].id}">${data[i].name}</td>`;
                    html += `<td contenteditable class="column_name" data-column_name="agency_name" data-id="${data[i].id}">${data[i].agency_name}</td>`;
                    html += `<td contenteditable class="column_name" data-column_name="prefix_rockets" data-id="'${data[i].id}'">${data[i].prefix_rockets}</td>`;
                    html += `<td><a id="${data[i].id}" style="color: inherit;text-decoration: none;">
                                <button type="button" class="bg-danger text-white delete-country-btn" data-bs-toggle="modal" data-bs-target="#delete-country-modal" data-countrydelete='${data[i].id}'>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </a></td></tr>`;
                }
                html += `<tr>`;
                html += `<td>--</td>`;
                html += `<td class="border-primary border-bottom" contenteditable id="name"></td>`;
                html += `<td class="border-primary border-bottom" contenteditable id="agency_name"></td>`;
                html += `<td class="border-primary border-bottom" contenteditable id="prefix_rockets"></td>`;
                html += `<td><a style="color: inherit;text-decoration: none;">
                            <button type="submit" id="add" class="bg-success text-white">
                                <i class="bi bi-plus"></i>
                            </button>
                        </a></td></tr>`;
                $('tbody').html(html);
                loadButtons();
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
                url:"{{ route("updateCountry") }}",
                method:"POST",
                data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
            })
        }
    });


    $(document).on('click', '.delete', function(){
        let id = $(this).attr("id");
        $.ajax({
            url:"{{ route("deleteCountry") }}",
            method:"POST",
            data:{id:id, _token:_token},
            success:function(data) {
                fetch_data();
            }
        });
    });

    function loadButtons(){
        const deleteCountryBtns = document.querySelectorAll(".delete-country-btn");
        const delBtn = document.querySelectorAll(".delete");
        for(let i = 0; i < deleteCountryBtns.length; i++){
            const countryDeleteData = deleteCountryBtns[i].dataset.countrydelete;
            deleteCountryBtns[i].addEventListener("click", ()=>{
                delBtn[0].id = countryDeleteData;
            });
        }
    }
});
</script>
@stop