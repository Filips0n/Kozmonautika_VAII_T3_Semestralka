<!-- The Modal -->
<div class="modal" id="editModalSpaceport">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-dark">Uprav kozmodróm</h4>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-dark">
                <div class="input-group">
                    <form method="post" id="spaceport-edit-form" enctype="multipart/form-data" class="w-100">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="spaceport_edit_country_id">Krajina:</label>
                                </div>
                                <select class="custom-select" name="spaceport_edit_country_id" id="spaceport-edit-country-id">
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" id="spaceport-edit-name" name="spaceport_edit_name" type="text" placeholder="Názov" maxlength="100" required
                                    oninvalid="setCustomValidity('Zadajte platný názov. Názov môže obsahovať len písmená, čísla a &quot; -_&quot; .')"
                                    oninput="setCustomValidity('')" >
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="spaceport_edit_launches" id="spaceport-edit-launches" type="number" placeholder="Počet štartov"  min="0" step="1" max="9999" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="spaceport_edit_active_from" id="spaceport-edit-active-from" type="number" placeholder="Aktívny od" min="1900" step="1" max="2022" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="spaceport_edit_latitude" id="spaceport-edit-latitude" type="number" placeholder="Zemepisná šírka (latitude)" min="-90" step="any" max="90" required>
                        </div>
                        <div class="form-group ">
                            <input class="form-control mb-1" name="spaceport_edit_longitude" id="spaceport-edit-longitude" type="number" placeholder="Zemepisná dĺžka (longitude)" min="-180" step="any" max="180" required>
                        </div>
                        <input type="submit" class="btn btn-primary" id="submit" name="spaceport-edit" value="Odoslať">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>