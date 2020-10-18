<?php

declare(strict_types=1);



use Illuminate\Database\Seeder;
use App\Models\System\Menu;
use App\Models\System\MenuItem;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Main Site
        $site = site(config('app.base_domain'));

        // Header Menu
        //------------------------------------------------//

        $menu = new Menu;
        $menu->type = Menu::NAVIGATION;
        $menu->name = 'primary-menu';
        $menu->label = 'Primary Menu';
        $menu->location = Menu::HEADER;
        $menu->status = Menu::ACTIVE;
        $menu->saveOrFail();

        $site->assignMenu($menu); // Add to site

        // Menu Items
        $items = [
            'For Practices' => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'for-practices',
                'title'     => 'Practices',
                'label'     => 'Practices',
                'url'       => '#',
                'target'    => MenuItem::TARGET_SELF
            ],
            'For Reps'      => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'for-reps',
                'title'     => 'For Reps',
                'label'     => 'For Reps',
                'url'       => '#',
                'target'    => MenuItem::TARGET_SELF
            ],
            'Resources'     => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'resource',
                'title'     => 'Resources',
                'label'     => 'Resources',
                'url'       => '#',
                'target'    => MenuItem::TARGET_SELF
            ],
            'Company'       => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'company',
                'title'     => 'Company',
                'label'     => 'Company',
                'url'       => '#',
                'target'    => MenuItem::TARGET_SELF
            ],
            'Request a Demo'    => [
                'type'          => MenuItem::PARENT_ITEM,
                'name'          => 'request-a-demo',
                'title'         => 'Request a Demo',
                'label'         => 'Request a Demo',
                'url'           => '#',
                'target'        => MenuItem::TARGET_SELF,
                'classes'       => 'nav-link bg-green fg-white rounded-pill pl-md-3 pr-md-3 d-inline-block'
            ],

        ];

        foreach ($items as $index => $item) {
            $menuItem = new MenuItem;
            $menuItem->type = $item['type'];
            $menuItem->name = $item['name'];
            $menuItem->title = $item['title'];
            $menuItem->label = $item['label'];
            $menuItem->url = $item['url'];
            $menuItem->target = $item['target'];
            $menuItem->saveOrFail();
            $menu->assignMenuItem($menuItem);
        }
    }
}
