<!-- The Modal -->
<div class="modal" id="ModalCreate-{{$country->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-dark">Pridaj nový kozmodróm</h4>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-dark">
                <div class="input-group">
                    <form method="post" action="{{route("createSpaceport")}}" enctype="multipart/form-data" class="w-100">
                        @csrf
                        <div class="form-group">
                            <input class="form-control mb-1" value="{{$country->id}}" name="country_id" type="hidden" min="0" step="1" max="9999" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" id="name" name="name" type="text" placeholder="Názov" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="launches" type="number" placeholder="Počet štartov"  min="0" step="1" max="9999" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="active_from" type="number" placeholder="Aktívny od" min="1900" step="1" max="2022" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="latitude" type="number" placeholder="Zemepisná šírka (latitude)" min="-90" step="any" max="90" required>
                        </div>
                        <div class="form-group ">
                            <input class="form-control mb-1" name="longitude" type="number" placeholder="Zemepisná dĺžka (longitude)" min="-180" step="any" max="180" required>
                        </div>
                        <input type="submit" class="btn btn-primary" id="submit" name="spaceport" value="Odoslať">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>