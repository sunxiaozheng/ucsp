@extends('layouts.app')

@section('category-title', '设置班级')

@section('content')
<div class="row">
    <div class="col-md-12">
        级组：<button type="button" class="btn btn-primary">增级</button>
        <button type="button" class="btn btn-primary">..</button>
        <button type="button" class="btn btn-primary">删级</button>
        <button type="button" class="btn btn-primary">填充级名称</button>
        <button type="button" class="btn btn-primary">上移</button>
        <button type="button" class="btn btn-primary">下移</button>
        班级：<button type="button" class="btn btn-primary">增班</button>
        <div class="btn-group">
            <button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-primary">删班</button>
        <button type="button" class="btn btn-primary">填充班名称</button>
        <button type="button" class="btn btn-primary">撤销填充</button>
        <button type="button" class="btn btn-primary">导入班级数据..</button>
    </div>
</div>
<div class="row">
    
</div>
@endsection

@section('vue-js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script type="text/javascript">
var vm = new Vue({
    el: '#demo',
    data: {
        firstName: 'Laravel',
        lastName: '{{ $username }}'
    },
    computed: {
        fullName: function () {
            return this.firstName + ' ' + this.lastName;
        }
    }
});
</script>
@endsection
