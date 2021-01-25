<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Models\System\Site;
use App\Models\System\Product;
use App\Models\System\Package;
use Illuminate\Support\Str;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = site(config('app.base_domain'));


        $json = [];
        $error = false;
        $stripe_error = null;
        $stripe_plan = false;
        $stripe_product = false;
        $product = false;

        $single_package = [
            'name'          => 'single',
            'label'         => 'Single Office Pass',
            'type'          => Package::LINKED_PRODUCT,
            'slug'          => 'single',
            'description'   => "Gain access to a single office.\nBecome discoverable in \"Rep Database\" with one office.\nRequest meetings and have access to the provider's calendar.",
            'price'         => cents(49),
            'trial_enabled' => Package::TRIAL_DISABLED,
            'interval'      => Package::YEARLY,
            'featured'      => Package::FEATURED,
            'status'        => Package::ACTIVE,
            'image'         => public_path('images/plan1.png')
        ];

        $unlimited_package = [
            'name'          => 'unlimted',
            'label'         => 'Unlimited Office Pass',
            'type'          => Package::LINKED_PRODUCT,
            'slug'          => 'unlimted',
            'description'   => "Gain access to unlimited offices.\nBecome discoverable in \"Rep Database\" with all offices.\nRequest meetings and have calendar access to any offices.",
            'price'         => cents(199),
            'trial_enabled' => Package::TRIAL_DISABLED,
            'interval'      => Package::YEARLY,
            'featured'      => Package::FEATURED,
            'status'        => Package::ACTIVE,
            'image'         => public_path('images/plan2.png')
        ];

        $packages = [
            $single_package,
            $unlimited_package
        ];

        //-------------------------//
        // Stripe Plans
        //-------------------------//

        \Stripe\Stripe::setApiKey(env('STRIPE_API_SECRET')); // stripe key

        $stripe_plans = \Stripe\Plan::all(["limit" => 100]); // get all plans

        foreach ($packages as $package) {
            $exists = false;

            $name = $package['name'];

            try {
                //-------------------------//
                // Create product
                //-------------------------//
                $stripe_product = \Stripe\Product::create([
                    'name'      => $name,
                    'active'    => ($package['status'] == Package::ACTIVE)? true : false
                ]);
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $json = json_decode(json_encode($e->getJsonBody()), false);
                $error = $json->error;
                $stripe_error = $error->message;
            }

            if (filled($stripe_error)) {
                logger($stripe_error);
                throw new Exception($stripe_error);
            }

            try {
                //-------------------------//
                // Create Plan
                //-------------------------//
                $stripe_plan = \Stripe\Plan::create([
                    'currency'          => 'usd',
                    'interval'          => $package['interval'],
                    'interval_count'    => 1,
                    'amount'            => $package['price'],
                    'product'           => $stripe_product->id,
                    'trial_period_days' => ($package['trial_enabled'] == Package::TRIAL_ENABLED)? 15 : 0,
                    'active'            => ($package['status'] == Package::ACTIVE)? true : false
                ]);
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $json = json_decode(json_encode($e->getJsonBody()), false);
                $error = $json->error;
                $stripe_error = $error->message;
            }

            if (filled($stripe_error)) {
                logger($stripe_error);
                throw new Exception($stripe_error);
            }


            // Create package plan
            if (filled($stripe_plan) && filled($stripe_product)) {
                $product = new Product;
                $product->uuid = Str::uuid();
                $product->name = $name;
                $product->label = $package['label'];
                $product->slug = $package['slug'];
                $product->type = 'single';
                $product->description = $package['description'];
                $product->price = $package['price'];
                $product->featured = $package['featured'];
                $product->status = $package['status'];
                $product->stripe_product = $stripe_product->id;
                $product->saveOrFail();

                $product->addMedia($package['image'])
                            ->preservingOriginal()
                            ->toMediaCollection('images');

                $site->assignProduct($product);

                $_package = new Package;
                $_package->uuid = Str::uuid();
                $_package->type = $package['type'];
                $_package->name = $package['name'] . '-plan';
                $_package->label = $package['label'] . ' Plan';
                $_package->slug = $package['slug'] . '-plan';
                $_package->description = $package['description'];
                $_package->price = $package['price'];
                $_package->trial_enabled = $package['trial_enabled'];
                $_package->interval = $package['interval'];
                $_package->featured = $package['featured'];
                $_package->status = $package['status'];
                $_package->stripe_plan = $stripe_plan->id;
                $_package->saveOrFail();
                $_package->assignProduct($product);

                $_package->addMedia($package['image'])
                            ->preservingOriginal()
                            ->toMediaCollection('images');

                $site->assignPackage($_package);
            }
        }
    }
}
