<div>
    <h3>hi {{ $customer->name }}</h3>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta molestias nam eum quaerat rem dolor iure odio,
        tempora accusamus maxime laudantium! Maiores sapiente debitis numquam possimus rem officia dicta non.

    </p>
    <p><a href="{{ route('account.reset_password', ['token' => $token]) }}">Click here to get new password</a></p>
</div>
