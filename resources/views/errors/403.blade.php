@extends('admin.admin')
@section('title')信息来源添加 @stop
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 403</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> 无权限操作.</h3>

                <p>
                    如果出现此页面可能您无权限执行此操作
                    您可以 联系您的管理员来解决此问题.
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