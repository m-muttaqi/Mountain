@extends('layouts/app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-header bg-success text-center">
						Contact List
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr class="text-center">
									<th>Sl. No</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Subject</th>
									<th>Message</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($contact_messages as $contact_message)
									<tr class={{ ($contact_message->read_status==1)?"bg-info":"" }}>
										<td>{{ $loop->index + 1 }}</td>
										<td>{{ $contact_message->first_name }}</td>
										<td>{{ $contact_message->last_name }}</td>
										<td>{{ $contact_message->subject }}</td>
										<td>{{ $contact_message->message }}</td>
										<td>
											<a href="{{ url('change/message/status') }}/{{ $contact_message->id }}" class="btn btn-sm btn-warning">Read/Unread</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection