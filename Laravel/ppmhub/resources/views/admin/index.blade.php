@extends('layout.adminlayout')
@section('title','Project | Project phase')
@section('body')
	@if(Session::has('flash_message'))
    <div class="alert alert-success">
    	<span class="glyphicon glyphicon-ok"></span>
    	<em> {!! session('flash_message') !!}</em>
    </div>
	@endif
	
	<section class="panel">
            <!--div class="panel-heading">
                <h3>
                    DataTables
                    <sup>
                        <small><a href="https://datatables.net/" target="_blank" class="link-underlined">Official Documentation</a></small>
                    </sup>
                </h3>
            </div-->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Project Phase</h4>
                        <div class="dashboard-buttons">
                            <a href="{{url('admin/projectphase/create')}}" class="btn btn-primary width-200 margin-top-10">
                                <i class="fa fa-send margin-right-5"></i>
                                Create Project Phase
                            </a>
                        </div>
                        <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                        <br />
                        <div class="margin-bottom-50">
							<table class="table table-inverse nowrap" id="example3" width="100%">
								<thead>
									<tr>
									  <th>Phase ID</th>
									  <th>Phase Name</th>
									  <th>Phase Type</th>
									  <!--th>Project Name</th-->
									  <th>Status</th>
									  <!--th>Start Date</th>
									  <th>End Date</th>
									  <th>Phase Reference</th>
									  <th>Created on</th>
									  <th>Created by</th-->
									  <th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
									  <th>Phase ID</th>
									  <th>Phase Name</th>
									  <th>Phase Type</th>
									  <!--th>Project Name</th-->
									  <th>Status</th>
									  <!--th>Start Date</th>
									  <th>End Date</th>
									  <th>Phase Reference</th>
									  <th>Created on</th>
									  <th>Created by</th-->
									  <th>Action</th>
									</tr>
								</tfoot>
								<tbody>
									@foreach($projectphase as $proj)
									<tr>
										<td>{{$proj->phase_Id }}</td>
										<td>{{$proj->phase_name}}</td>
										<td>{{$proj->phase_type }}</td>
										<!--td>{{$proj->project_id }}</td-->
										<td>
											@if($proj->status=='1')
												<img src="{{asset('vendors/common/img/green.png')}}" alt="">
											<!--button type="button" class="btn btn-success btn-xs">Active</button-->
											@else
												<img src="{{asset('vendors/common/img/red.png')}}" alt="">
												
											<!--button type="button" class="btn btn-danger btn-xs">Inactive</button-->
											@endif
										</td>
										<!--td>{{$proj->start_date }}</td>
										<td>{{$proj->end_date }}</td>
										
										<td>{{$proj->reference_phase }}</td>
										<td>{{$proj->created_date }}</td>
										<td>{{$proj->created_by }}</td-->
										
										<td class="action-btn" style="text-align: center; padding: 12px;">
											<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#table-view-popup_{{$proj->id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
											
											<a href="{{url('admin/projectphase/'.$proj->id.'/edit')}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> <!--Edit--> </a>
											
											<form action="{{url('admin/projectphase/'.$proj->id)}}" method="post" id="delform">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
											<a href="javascript:void(0)" onclick="var res=confirm('Are you sure you want to delete this project phase'); if(res){document.getElementById('delform').submit()}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete --></a>
											</form>
											
											<div class="modal fade table-view-popup" id="table-view-popup_{{$proj->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
												<div class="modal-dialog" role="document" style="text-align:left;">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															<h4 class="modal-title" id="myModalLabel">{{$proj->phase_name}}</h4>
														</div>
														<div class="modal-body">
															<form class="static-form">
																<div class="form-group popup-brd-btm">
																	<div class="col-sm-5">
																		<p class="form-control-static">Project ID</p>
																	</div>
																	<div class="col-sm-5">
																		<p class="form-control-static">
																			{{$proj->project_id }}
																		</p>
																	</div>
																</div>
																<div class="form-group popup-brd-btm">
																	<div class="col-sm-5">
																		<p class="form-control-static">Start Date</p>
																	</div>
																	<div class="col-sm-5">
																		<p class="form-control-static">
																			{{$proj->start_date }}
																		</p>
																	</div>
																</div>
																<div class="form-group popup-brd-btm">
																	<div class="col-sm-5">
																		<p class="form-control-static">End Date</p>
																	</div>
																	<div class="col-sm-5">
																		<p class="form-control-static">
																			{{$proj->end_date }}
																		</p>
																	</div>
																</div>
																<div class="form-group popup-brd-btm">
																	<div class="col-sm-5">
																		<p class="form-control-static">Phase Reference</p>
																	</div>
																	<div class="col-sm-5">
																		<p class="form-control-static">
																			{{$proj->reference_phase }}
																		</p>
																	</div>
																</div>
																<div class="form-group popup-brd-btm">
																	<div class="col-sm-5">
																		<p class="form-control-static">Created On</p>
																	</div>
																	<div class="col-sm-5">
																		<p class="form-control-static">
																			{{$proj->created_date }}
																		</p>
																	</div>
																</div>
																<div class="form-group popup-brd-btm">
																	<div class="col-sm-5">
																		<p class="form-control-static">Created By</p>
																	</div>
																	<div class="col-sm-5">
																		<p class="form-control-static">
																			{{$proj->created_by }}
																		</p>
																	</div>
																</div>
															</form>
														</div>
														<div class="modal-footer">
															<a href="{{url('admin/projectphase/'.$proj->id.'/edit')}}" class="btn btn-primary">Edit Project phase</a>
															<button type="button" class="btn" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection