@extends('admin.admin')
@section('title')信息来源添加 @stop
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 503</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> 程序错误.</h3>

                <p>
                    如果出现此页面可能程序出现致命错误，请联系管理员解决此问题.
                </p>

                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
@stop