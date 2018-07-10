<div class="form-inline float-left mb-3 mr-8">
   <form id="search" action="{{ route('simrs.rawatjalan') }}" class="form-inline" role="search" >
        <div class="controls">
            <div class='input-group date {{ $errors->has('serach') ? 'has-error' : '' }}'>
                <input type='text' name="search" class="form-control" />
            </div>
        </div>
        <button type="submit" class="btn btn-secondary">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
<div class="form-inline float-right mb-4 mr-8">
    <form id="tanggal" action="{{ route('simrs.rawatjalan') }}" class="form-inline" role="search" >
        <div class="controls">
            {{-- Tanggal pertama --}}
            <div class='input-group date {{ $errors->has('tgl1') ? 'has-error' : '' }}' id='datetimepicker1'>
                <input type='text' name="tgl1" class="form-control" />
                <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
            </div>
            s/d
            {{-- Tanggal kedua --}}
            <div class='input-group date {{ $errors->has('tgl2') ? 'has-error' : '' }}' id='datetimepicker2'>
                <input type='text' name="tgl2" class="form-control" />
                <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
            </div>
        </div>
    <button type="submit" class="btn btn-secondary">
        <i class="fa fa-search"></i>
    </button>
    </form>
</div>