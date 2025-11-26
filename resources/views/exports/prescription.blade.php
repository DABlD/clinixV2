@php
	// dd(asset($clinic->logo));
	// dd($prescriptions, $clinic, auth()->user()->doctor);
@endphp

<style>
	.footer {
	    position: absolute;
	    bottom: 15px;
	    left: 0;
	    right: 0;
	    text-align: center;
	    font-size: 12px;
	}

	body {
	    margin-bottom: 60px; /* leave space for footer */
	}

	.signature-wrap{
	  position: relative;          /* create stacking context */
	  display: inline-block;       /* shrink to content width */
	  padding-top: 0.6rem;         /* room if you want signature above text */
	}

	.name{
	  font-size: 0.8rem;
	  text-align: center;
	  /* keep normal flow */
	}

	/* signature overlaps name, positioned above (negative top) */
	.signature-img{
	  position: absolute;
	  top: -18px;                  /* move above the name; tweak as needed */
	  left: 50%;
	  transform: translateX(-50%);
	  width: 160px;                /* scale signature */
	  pointer-events: none;        /* clicks pass through to elements below */
	  z-index: 10;
	  opacity: 0.95;               /* nice subtle feel */
	}
</style>

<table style="width: 100%; border-collapse: collapse; text-align: center; font-family: 'Roboto';">
    <tr>
        <td style="width: 25%; text-align: center; vertical-align: middle;">
            <img src="file://{{ public_path($clinic->logo) }}" alt="Clinic Logo" height="70px">
        </td>

        <td style="width: 50%; text-align: center; vertical-align: middle; font-size: 12px; line-height: 1.4;">
        	<b>
	            <span style="font-size: 16px;">{{ $clinic->name }}</span><br>
	            {{ auth()->user()->fname }} {{ auth()->user()->lname }}, M.D.{{ auth()->user()->doctor?->title ? ", " . auth()->user()->doctor->title : "" }}<br>
	            {{ auth()->user()->doctor?->specialization }}<br>
        	</b>
	            {{ $clinic->location }}
        </td>

        <td style="width: 25%; text-align: center; vertical-align: middle;">
            <img src="file://{{ public_path('images/logo.png') }}" alt="OHN Logo" height="70px">
        </td>
    </tr>
</table>

<hr style="height: 1px; color: black; background-color: black; width: 100%; margin-top: 20px; margin-bottom: 20px;">

<table style="width: 100%; border-collapse: collapse; text-align: center; font-family: 'Roboto';">
	<tr>
		<td colspan="3" style="width: 100%; font-weight: bold;">PRESCRIPTION</td>
	</tr>

	<br>
	<br>

	<tr style="text-align: left; font-size: 12px;">
		<td style="width: 5%;"></td>
		<td style="width: 70%;" style="text-align: left;">
			<b>Name:</b>
			{{ ucfirst($patient->fname) }} {{ ucfirst($patient->mname) }} {{ ucfirst($patient->lname) }}
		</td>
		<td style="width: 25%;">
			<b>Age:</b>
			{{ $patient->birthday ? $patient->birthday->age : "-" }}, {{ $patient->gender }}
		</td>
	</tr>

	<tr style="text-align: left; font-size: 12px;">
		<td style="width: 5%;"></td>
		<td style="width: 70%;">
			<b>Address:</b>
			{{ $patient->address }}
		</td>
		<td style="width: 25%;">
			<b>Date:</b>
			{{ now()->format("F j, Y") }}
		</td>
	</tr>

	<br>

	<tr>
		<td></td>
		<td style="text-align: left;" colspan="2">
			<img src="{{ public_path("images/rx.png") }}" alt="RX" style="height: 40px;">
		</td>
	</tr>

	<br>

	@foreach($prescriptions as $prescription)
		<tr style="text-align: left;">
			<td></td>
			<td style="font-size: 10px;">
				<table style="width: 100%;">
					<tr>
						<td style="width: 10%;"></td>
						<td style="width: 5%;">{{ $loop->index+1 }}.</td>
						<td style="width: 40%;">
							<b>{{ $prescription->generic_name }}</b>
						</td>
						<td style="width: 45%;">#{{ $prescription->qty }}</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>({{ $prescription->brand_name }})</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>{{ $prescription->form }}</td>
						<td></td>
					</tr>
					<tr><td colspan="4"></td></tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan="2">
							<span style="text-decoration: underline;">Instructions:</span> {{ $prescription->instruction }}
						</td>
					</tr>

				</table>
				<pre>
					
					<br>
					<br>
					<br>
					
				</pre>
			</td>
		</tr>
	@endforeach
</table>

<div class="footer">
    <table style="width: 100%;">
    	<tr>
    		<td style="width: 50%;"></td>
    		<td style="width: 15%;"></td>
    		<td style="width: 15%;"></td>
    		<td style="width: 20%;"></td>
    	</tr>

    	<tr>
    		<td></td>
    		<td colspan="2" style="text-align: center; font-weight: bold;">
    			<div class="signature-wrap" style="width:300px;">
    				<img src="{{ public_path(auth()->user()->doctor?->signature) }}" height="50px"><br>
    			  	<div class="name">{{ auth()->user()->fname }} {{ auth()->user()->lname }}, M.D.{{ auth()->user()->doctor?->title ? ", " . auth()->user()->doctor->title : "" }}</div>
    			</div><br>
    			{{ auth()->user()->doctor?->specialization }}
    		</td>
    		<td></td>
    	</tr>

    	<tr>
    		<td></td>
    		<td style="font-weight: bold;">License No:</td>
    		<td style="border-bottom: 1px black solid;">{{ auth()->user()->doctor?->license_number }}</td>
    		<td></td>
    	</tr>

    	<tr>
    		<td></td>
    		<td style="font-weight: bold;">PTR No:</td>
    		<td style="border-bottom: 1px black solid;">{{ auth()->user()->doctor?->ptr }}</td>
    		<td></td>
    	</tr>

    	<tr>
    		<td></td>
    		<td style="font-weight: bold;">S2 No:</td>
    		<td style="border-bottom: 1px black solid;">{{ auth()->user()->doctor?->s2_number }}</td>
    		<td></td>
    	</tr>

    	<tr>
    		<td>Next Appointment:</td>
    	</tr>

    </table>

    <hr style="height: 1px; color: black; background-color: black; width: 100%; margin-top: 20px; margin-bottom: 20px;">

    <center style="font-size: 10px;">
    	Powered by: <b>OneHealth Network</b>
    </center>
</div>