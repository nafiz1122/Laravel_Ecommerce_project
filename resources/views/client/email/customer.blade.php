
    <div style="border: 2px solid black">
        <div style="padding:8px 25px;background-color: #007bff;color:white" class="card-header bg-success text-white">
            <h1>Welcome to EShopper</h1>
        </div>
        <div style="padding: 80px">
            <h3>Your Details</h3>
                <ul>
                    <li><p>Name:{{$name}}</p></li>
                    <li><p>Email:{{$email}}</p></li>
                    <li><p>Phone:{{$phone}}</p></li>
                    <li><p>Password:{{$password}}</p></li>
                </ul>
            <h1 style="font-weight:bold" >Your varification code is: {{ $code}} </h1>
        </div>
        <div style="text-align:center">
            <h3>We will contact with you soon</h3>
        </div>
    </div>


