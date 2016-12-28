<div class="block_sort_by">
    <span class="text">SORTEAZĂ DUPĂ:</span>
    <form action="">
        <div class="input-field with_caret">
            <div class="select-wrapper">
                <span class="caret"></span>
                <input type="hidden" class="select-dropdown" readonly="true"
                       data-activates="select-options-34fad79b-f324-8d26-799e-d9fa33ce9332"
                       value="Denumire ">
                <ul id="select-options-34fad79b-f324-8d26-799e-d9fa33ce9332" class="dropdown-content select-dropdown"
                    style="width: 180px; position: absolute; top: 0; left: 0; opacity: 1; display: none;">

                    <li class="disabled active"><span>Denumire </span></li>
                    <li class=""><span>Option 1</span></li>
                    <li class=""><span>Option 2</span></li>
                    <li class=""><span>Option 3</span></li>
                </ul>

                <select class="initialized" onchange="this.form.submit()" name="name">
                    <option value="">Denumire</option>
                    <option value="asc" {{ isset($_GET['name']) ? $_GET['name'] == 'asc' ? 'selected' : '' : '' }}>A - z</option>
                    <option value="desc" {{ isset($_GET['name']) ? $_GET['name'] == 'desc' ? 'selected' : '' : '' }}>Z - a</option>
                </select>
            </div>

        </div>
        <div class="input-field with_caret">
            <div class="select-wrapper">
                <span class="caret"></span>
                <input type="hidden" class="select-dropdown" readonly="true"
                       data-activates="select-options-f6563312-9274-afd1-18a2-20506a229555"
                       value="Timp">
                <ul id="select-options-f6563312-9274-afd1-18a2-20506a229555"
                    class="dropdown-content select-dropdown"
                    style="width: 180px; position: absolute; top: 0px; left: 0px; opacity: 1; display: none;">
                    <li class="disabled active"><span>Timp</span></li>
                    <li class=""><span>Option 1</span></li>
                    <li class=""><span>Option 2</span></li>
                    <li class=""><span>Option 3</span></li>
                </ul>
                <select class="initialized" onchange="this.form.submit()" name="date">
                    <option value="">Timp</option>
                    <option value="asc" {{ isset($_GET['date']) ? $_GET['date'] == 'asc' ? 'selected' : '' : '' }}>По старым</option>
                    <option value="desc" {{ isset($_GET['date']) ? $_GET['date'] == 'desc' ? 'selected' : '' : '' }}>По новым</option>
                </select></div>
        </div>
        <div class="input-field with_caret">
            <div class="select-wrapper">
                <span class="caret"></span>
                <input type="hidden"
                       class="select-dropdown"
                       readonly="true"
                       data-activates="select-options-93044d97-f0c9-d0d0-0d6e-13a221c4642f"
                       value="Preț">
                <ul id="select-options-93044d97-f0c9-d0d0-0d6e-13a221c4642f"
                    class="dropdown-content select-dropdown"
                    style="width: 180px; position: absolute; top: 0px; left: 0px; opacity: 1; display: none;">
                    <li class="disabled active"><span>Preț</span></li>
                    <li class=""><span>Option 1</span></li>
                    <li class=""><span>Option 2</span></li>
                    <li class=""><span>Option 3</span></li>
                </ul>
                <select class="initialized" onchange="this.form.submit()" name="price">
                    <option value="">Preț</option>
                    <option value="asc" {{ isset($_GET['price']) ? $_GET['price'] == 'asc' ? 'selected' : '' : '' }}>По дешовым</option>
                    <option value="desc" {{ isset($_GET['price']) ? $_GET['price'] == 'desc' ? 'selected' : '' : '' }}>По дорогим</option>
                </select>
            </div>
        </div>
    </form>
</div>