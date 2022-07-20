@extends('admin.layouts.index')
@section('title', 'Category List')
@section('content')
<div class="container page__container">
    <div class="card card-form">
        <div class="row no-gutters">
            <div class="col-lg-4 card-body">
                <p><strong class="headings-color">Toggle Checkboxes</strong></p>
                <p class="text-muted">A tiny plugin which adds the ability to toggle all checkboxes within a table.</p>
            </div>
            <div class="col-lg-8 card-form__body">


                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                    <table class="table mb-0 thead-border-top-0">
                        <thead>
                            <tr>

                                <th style="width: 18px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-toggle-check-all" data-target="#staff" id="customCheckAll">
                                        <label class="custom-control-label" for="customCheckAll"><span class="text-hide">Toggle all</span></label>
                                    </div>
                                </th>

                                <th>Employee</th>


                                <th style="width: 37px;">Status</th>
                                <th style="width: 120px;">Last Activity</th>
                                <th style="width: 51px;">Earnings</th>
                                <th style="width: 24px;"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="staff">

                            <tr class="selected">

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" checked="" id="customCheck1_1">
                                        <label class="custom-control-label" for="customCheck1_1"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="media align-items-center">
                                        <div class="avatar avatar-xs mr-2">
                                            <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">

                                            <span class="js-lists-values-employee-name">Michael Smith</span>

                                        </div>
                                    </div>

                                </td>


                                <td><span class="badge badge-warning">ADMIN</span></td>
                                <td><small class="text-muted">3 days ago</small></td>
                                <td>&dollar;12,402</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="customCheck2_1">
                                        <label class="custom-control-label" for="customCheck2_1"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="media align-items-center">
                                        <img src="assets/images/avatar/green.svg" class="mr-2" alt="avatar" />
                                        <div class="media-body">

                                            <span class="js-lists-values-employee-name">Connie Smith</span>

                                        </div>
                                    </div>

                                </td>


                                <td><span class="badge badge-success">USER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="customCheck3_1">
                                        <label class="custom-control-label" for="customCheck3_1"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="media align-items-center">

                                        <div class="avatar avatar-xs mr-2">
                                            <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">

                                            <span class="js-lists-values-employee-name">John Connor</span>

                                        </div>
                                    </div>

                                </td>


                                <td><span class="badge badge-primary">MANAGER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                            <tr class="selected">

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" checked="" id="customCheck1_2">
                                        <label class="custom-control-label" for="customCheck1_2"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="media align-items-center">
                                        <div class="avatar avatar-xs mr-2">
                                            <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">

                                            <span class="js-lists-values-employee-name">Michael Smith</span>

                                        </div>
                                    </div>

                                </td>


                                <td><span class="badge badge-warning">ADMIN</span></td>
                                <td><small class="text-muted">3 days ago</small></td>
                                <td>&dollar;12,402</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="customCheck2_2">
                                        <label class="custom-control-label" for="customCheck2_2"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="media align-items-center">
                                        <img src="assets/images/avatar/green.svg" class="mr-2" alt="avatar" />
                                        <div class="media-body">

                                            <span class="js-lists-values-employee-name">Connie Smith</span>

                                        </div>
                                    </div>

                                </td>


                                <td><span class="badge badge-success">USER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input js-check-selected-row" id="customCheck3_2">
                                        <label class="custom-control-label" for="customCheck3_2"><span class="text-hide">Check</span></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="media align-items-center">

                                        <div class="avatar avatar-xs mr-2">
                                            <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">

                                            <span class="js-lists-values-employee-name">John Connor</span>

                                        </div>
                                    </div>

                                </td>


                                <td><span class="badge badge-primary">MANAGER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

    <div class="card card-form">
        <div class="row no-gutters">
            <div class="col-lg-4 card-body">
                <p><strong class="headings-color">Search</strong></p>
                <p class="text-muted">Add search functionality to your tables with List.js. Please read the <a href="http://listjs.com/" target="_blank">official plugin documentation</a> for a full list of options.</p>
            </div>
            <div class="col-lg-8 card-form__body">

                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                    <div class="search-form search-form--light m-3">
                        <input type="text" class="form-control search" placeholder="Search">
                        <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                    </div>

                    <table class="table mb-0 thead-border-top-0">
                        <thead>
                            <tr>

                                <th>Employee</th>


                                <th style="width: 37px;">Status</th>
                                <th style="width: 120px;">Last Activity</th>
                                <th style="width: 51px;">Earnings</th>
                                <th style="width: 24px;"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="staff02">

                            <tr>

                                <td>

                                    <span class="js-lists-values-employee-name">Michael Smith</span>

                                </td>


                                <td><span class="badge badge-warning">ADMIN</span></td>
                                <td><small class="text-muted">3 days ago</small></td>
                                <td>&dollar;12,402</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>

                                    <span class="js-lists-values-employee-name">Connie Smith</span>

                                </td>


                                <td><span class="badge badge-success">USER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>

                                    <span class="js-lists-values-employee-name">John Connor</span>

                                </td>


                                <td><span class="badge badge-primary">MANAGER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                            <tr>

                                <td>

                                    <span class="js-lists-values-employee-name">Michael Smith</span>

                                </td>


                                <td><span class="badge badge-warning">ADMIN</span></td>
                                <td><small class="text-muted">3 days ago</small></td>
                                <td>&dollar;12,402</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>

                                    <span class="js-lists-values-employee-name">Connie Smith</span>

                                </td>


                                <td><span class="badge badge-success">USER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>
                            <tr>

                                <td>

                                    <span class="js-lists-values-employee-name">John Connor</span>

                                </td>


                                <td><span class="badge badge-primary">MANAGER</span></td>
                                <td><small class="text-muted">1 week ago</small></td>
                                <td>&dollar;1,943</td>
                                <td><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

    <div class="card card-form">
        <div class="row no-gutters">
            <div class="col-lg-4 card-body">
                <p><strong class="headings-color">Sort Columns</strong></p>
                <p class="text-muted">Add sorting functionality to your tables with by List.js. Please read the <a href="http://listjs.com/" target="_blank">official plugin documentation</a> for a full list of options.</p>
            </div>
            <div class="col-lg-8 card-form__body border-left">


                <div data-toggle="lists" data-lists-values='["js-lists-values-employee-name", "js-lists-values-employee-title"]' class="table-responsive border-bottom">
                    <table class="table mb-0 thead-border-top-0">
                        <thead class="bg-white">
                            <tr>
                                <th colspan="2">
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">Employee name</a>
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-title">Employee title</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list">

                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="assets/images/256_rsz_1andy-lee-642320-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <strong class="js-lists-values-employee-name">Jenell D. Matney</strong><br>
                                            <span class="text-muted js-lists-values-employee-title">Founder and CEO</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right"><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <strong class="js-lists-values-employee-name">Sherri J. Cardenas</strong><br>
                                            <span class="text-muted js-lists-values-employee-title">Software Engineer</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right"><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="assets/images/256_jeremy-banks-798787-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <strong class="js-lists-values-employee-name">Joseph S. Ferland</strong><br>
                                            <span class="text-muted js-lists-values-employee-title">Web Designer</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right"><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="assets/images/256_joao-silas-636453-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <strong class="js-lists-values-employee-name">Bryan K. Davis</strong><br>
                                            <span class="text-muted js-lists-values-employee-title">Web Developer</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right"><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <strong class="js-lists-values-employee-name">Elizabeth J. Ohara</strong><br>
                                            <span class="text-muted js-lists-values-employee-title">Business Analyst</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right"><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="assets/images/256_michael-dam-258165-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <strong class="js-lists-values-employee-name">Kaci M. Langston</strong><br>
                                            <span class="text-muted js-lists-values-employee-title">Human Resources</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right"><a href="" class="text-muted"><i class="material-icons">more_vert</i></a></td>
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
  <!-- List.js -->
  <script src="{{ asset('admin/assets/vendor/list.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/list.js') }}"></script>
@endsection
