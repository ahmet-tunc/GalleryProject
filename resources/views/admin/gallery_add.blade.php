@extends('layouts.admin.admin')

@section('title')
    Galeri
@endsection

@section('css')
@endsection

@section('content')
    <?php $lastOrder = 0; ?>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <h5>Galeri İşlemleri</h5>
                </div>
            </div>
            <div class="panel-body p-50">

                <form>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="name">Adı</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       autofocus="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="image">Kapak Resmi</label>
                                <input type="file" class="form-control" id="image" placeholder="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="description">Açıklama</label>
                                <textarea name="description" id="description" cols="200"
                                          style="max-height: 120px; min-height: 50px; min-width: 50px" rows="5"></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="orderid">Sıra Numarası</label>
                                <input type="number" class="form-control" id="orderid">

                                <div class="form-group">
                                    <label for="status">Aktif / Pasif
                                        <input type="checkbox" class="" id="status" placeholder="status">
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Kaydet</button>

                            </div>
                        </div>
                    </div>




                </form>

            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
@endsection
