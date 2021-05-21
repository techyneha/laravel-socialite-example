# [Laravel Socialite](https://laravel.com/docs/7.x/socialite)
What is Laravel Socialite ?
Laravel Socialite is a package developed to abstract away any social authentication complexities and boilerplate code into a fluent and expressive interface.

Socialite only supports Google, Facebook, Twitter, LinkedIn, Github, and Bitbucket as OAuth providers. They won’t be adding any others to the list, however, there’s a community-driven collection called Socialite Providers, which contains plenty of unofficial providers for Socialite. More on this in the next section.

##### I’ll assume you already have a fresh Laravel application instance up and running on your machine, so you can see the code in action along the way.



## Getting Started

####To get started with Socialite, we install it with Composer:


## Step 1:Install Laravel Socialite.

````
composer require laravel/socialite
````

## Step 2:Once installed, Socialite’s service provider and facade should be registered in config/app.php .


````
// ...

'providers' => [
        // ...
        /*
         * Package Service Providers...
         */      
        Laravel\Socialite\SocialiteServiceProvider::class,
    ],

// ...

// ...
'aliases' => [
        // ...
        'Socialite' => Laravel\Socialite\Facades\Socialite::class,
    ],
// ...

````

## Step 3: Add the credentials in config/services.php for each provider:
To use any provider, we need to register an OAuth application on that provider platform. In return, we’ll be given a pair of client ID and client secret keys as our credentials for interacting with the provider’s API. 

````
// ...

'facebook' => [
        'client_id'     => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect'      => env('FB_URL'),
],

'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('GOOGLE_URL'),
],

'github' => [
        'client_id'     => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect'      => env('GITHUB_URL'),
],

````
The actual key values are put into the .env file in the project’s root directory.

To modify the schema, we use Laravel’s schema builder. Before modifying the fields in the existing tables, we need to have doctrine/dbal package installed.

## Step 4:Install doctrine/dbal package.

````
composer require doctrine/dbal
````

## Step 5:Step to Add and modify migrations.

````
php artisan make:migration prepare_users_table_for_social_authentication --table users

````
Now, we make email and password fields nullable:

Code inside above migration will be :

````
<?php

// ...

/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

        // Making email and password nullable
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();

        });
    }

// ...
````

For storing a user’s linked social accounts, we create the model and its migration file together:
````
php artisan make:model LinkedSocialAccount --migration
````
Code inside LinkedSocialAccount:

````
<?php

// ...
public function up()
    {
        Schema::create('linked_social_accounts', function (Blueprint $table) {

            $table->increments('id');
            $table->bigInteger('user_id');           
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->unique()->nullable();          
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linked_social_accounts');
    }

// ...
````
####To apply the changes, we run migrate:
````
php artisan migrate
````


## Step 6:Add linked detail in User model

File: app/User.php
```
 // ...

public function accounts(){
    return $this->hasMany('App\LinkedSocialAccount');
}

 // ...
```
Let’s add the inverse of this relationship in LinkedSocialAccount model as well:

File: app/LinkedSocialAccounts.php
```
<?php
// ...

protected $fillable = ['provider_name', 'provider_id' ];

public function user()
{
    return $this->belongsTo('App\User');
}

// ...

```

##Step 7: Create SocialAccountController Controller.
````
php artisan make:controller 'Auth\SocialAccountController'
````

Add below code inside ####File: app/Http/Controllers/Auth/SocialAccountController.php

```
// ...
<?php

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(\App\SocialAccountsService $accountService, $provider)
    {

        try {
            $user = \Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $authUser = $accountService->findOrCreate(
            $user,
            $provider
        );

        auth()->login($authUser, true);

        return redirect()->to('/home');
    }
}
// ...
```


## Step 8:Now, let’s create our helper class SocialAccountService.php.

Under the App namespace, create a file with the following code:

####File: app/SocialAccountService.php

```
<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $account = LinkedSocialAccount::where('provider_name', $provider)
                   ->where('provider_id', $providerUser->getId())
                   ->first();

        if ($account) {
            return $account->user;
        } else {

        $user = User::where('email', $providerUser->getEmail())->first();

        if (! $user) {
            $user = User::create([  
                'email' => $providerUser->getEmail(),
                'name'  => $providerUser->getName(),
            ]);
        }

        $user->accounts()->create([
            'provider_id'   => $providerUser->getId(),
            'provider_name' => $provider,
        ]);

        return $user;

        }
    }
}

````

## Step 9:Add Routes for social login.
####File: routes/web.php


```
<?php

// ...

Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

```


##We need to register a new OAuth application: 

#### Github : [Github](https://github.com/settings/applications/new).
#### Facebook : [Facebook](https://developers.facebook.com/apps).
#### Google : [Google](https://console.developers.google.com/projectcreate).
