<div class="modal" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-dark">Uprav raketu</h4>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-dark">
                <div class="input-group">
                    <form method="post" id="rocket-edit-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input class="form-control mb-1" name="rocket_edit_name" type="text" placeholder="Názov" id="rocket-edit-name"
                                   maxlength="20" pattern="[A-Za-z0-9 _-]+" required
                                   oninvalid="setCustomValidity('Zadajte platný názov. Názov môže obsahovať len písmená, čísla a &quot; -_&quot; .')"
                                   oninput="setCustomValidity('')" >
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="rocket-edit-human-rated">Posádka:</label>
                                </div>
                                <select class="custom-select" name="rocket_edit_human_rated" id="rocket-edit-human-rated">
                                    <option value="0">Nie</option>
                                    <option value="1">Áno</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="manufacturer_id">Výrobca:</label>
                                </div>
                                <select class="custom-select" name="rocket_edit_manufacturer_id" id="rocket-edit-manufacturer">
                                    @foreach ($manufacturers as $manufacturer)
                                        <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="rocket_edit_payload" type="number" placeholder="Nosnosť" id="rocket-edit-payload" min="0" step="0.01" max="999" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="rocket_edit_height" type="number" placeholder="Výška" id="rocket-edit-height" min="0" step="0.01" max="999" required>
                        </div>
                        <input type="submit" class="btn btn-primary" name="rocket-edit" value="Odoslať">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>