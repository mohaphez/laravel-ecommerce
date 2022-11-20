 <link href="{{URL::to('css/bootstrap-select.min.css')}}" rel="stylesheet">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title text-right">ویرایش منو</h4>
</div>
<div class="modal-body text-right">
    <p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>انتخاب دسته</label>
                    <select id="category" name="category" class="form-control selectpicker text-right" data-live-search="true" title="دسته بندی را انتخاب کنید">
                        @foreach($categories as $category)
                        <option value="{{ Hashids::encode($category->id) }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>انتخاب زیر دسته</label>
                    <select name="sub" id="subcategory" class="form-control selectpicker" data-live-search="true" title="زیر دسته بندی را انتخاب کنید">
                    </select>
                </div>
            </div>
        </div>
    </p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
</div>
<script src="{{URL::to('manage/js/jquery-1.11.0.js')}}"></script>
 <script src="{{URL::to('js/bootstrap-select.min.js')}}"></script>