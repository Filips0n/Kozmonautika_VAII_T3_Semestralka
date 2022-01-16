<!-- The Modal -->
<div class="modal" id="ModalCreate-{{$country->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-dark">Pridaj novú raketu</h4>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-dark">
                <div class="input-group">
                    <form method="post" action="{{route("createRocket")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file">
                            <input name="file" type="file" class="form-control mb-1" id="customFile" accept=".jpg,.png,.jpeg,.bmp" maxlength="100" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" id="name" name="name" type="text" placeholder="Názov" maxlength="20" pattern="[A-Za-z0-9 _-]+" required
                                    oninvalid="setCustomValidity('Zadajte platný názov. Názov môže obsahovať len písmená, čísla a &quot; -_&quot; .')"
                                    oninput="setCustomValidity('')" >
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="human_rated">Posádka:</label>
                                </div>
                                <select class="custom-select" id="human_rated" name="human_rated">
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
                                <select class="custom-select" id="manufacturer_id" name="manufacturer_id">
                                    @foreach ($country->manufacturers as $manufacturer)
                                        <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="payload" type="number" placeholder="Nosnosť"  min="0" step="0.01" max="999" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control mb-1" name="height" type="number" placeholder="Výška" min="0" step="0.01" max="999" required>
                        </div>
                        <input type="submit" class="btn btn-primary" id="submit" name="rocket" value="Odoslať">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>