<!-- resources/views/show_members.blade.php -->

@extends('admin_layout')
@section('admin-content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Member
            </div>
            <table class="table">
                {{-- Message hiển thị thông báo active --}}
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<p class="text-alert " style="color:green; ">' . $message . '</p>';
                    Session::put('message', null);
                }
                ?>
                {{-- End Message --}}

                {{-- Message hiển thị thông báo unactive --}}
                <?php
                $message1 = Session::get('message1');
                if ($message1) {
                    echo '<p class="text-alert " style="color:red; ">' . $message1 . '</p>';
                    Session::put('message1', null);
                }
                ?>
                {{-- End Message --}}
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">

                    </div>
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="button">Go</button>
                            </span>
                        </div>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Year of Birth</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_member as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->yob }}</td>
                            <td>
                                @if ($item->is_banned)
                                    <form method="POST" action="{{ route('unban-member', $item->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Unban</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('ban-member', $item->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Ban</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
