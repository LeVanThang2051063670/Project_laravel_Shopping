<h3>Hi {{ $account->name }}</h3>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, velit vero provident unde, nam voluptatum a
    sunt libero ducimus consequuntur assumenda? Nihil veritatis vel iure, necessitatibus fugit atque unde consectetur?

</p>

<p><a href="{{ route('account.veryfy', $account->email) }}">Click here to verify your account</a></p>
