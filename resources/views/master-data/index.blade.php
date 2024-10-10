@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Master Data</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap align-middle table-hover mb-0">
                        <tbody>
                            <tr onclick="location.href='{{ route('departements.index') }}';">
                                <td style="width: 45px;">
                                    <div class="avatar-sm">
                                        <span
                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                            <i class="bx bx-building"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                            class="text-dark">Role</a></h5>
                                    <small>Manajemen role</small>
                                </td>
                            </tr>
                            <tr onclick="location.href='{{ route('users.index') }}';">
                                <td>
                                    <div class="avatar-sm">
                                        <span
                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                            <i class="bx bx-user-circle"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                            class="text-dark">User</a></h5>
                                    <small>Manajemen user</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
