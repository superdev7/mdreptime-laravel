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
            'Offices' => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'offices',
                'title'     => 'Offices',
                'label'     => 'Offices',
                'url'       => '/page/offices',
                'target'    => MenuItem::TARGET_SELF
            ],
            'Representatives' => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'representatives',
                'title'     => 'Representatives',
                'label'     => 'Representatives',
                'url'       => '/page/representatives',
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
                'url'       => '/page/company',
                'target'    => MenuItem::TARGET_SELF
            ],
            'Request a Demo'    => [
                'type'          => MenuItem::PARENT_ITEM,
                'name'          => 'request-a-demo',
                'title'         => 'Request a Demo',
                'label'         => 'Request a Demo',
                'url'           => '/page/request-a-demo',
                'target'        => MenuItem::TARGET_SELF,
                'css_classes'   => 'nav-link bg-green fg-white rounded-pill pl-md-3 pr-md-3 d-inline-block'
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
            if(isset($item['css_classes'])) {
                $menuItem->css_classes = $item['css_classes'];
            }
            $menuItem->saveOrFail();
            $menu->assignMenuItem($menuItem);
        }

        // Footer Menu
        $menu = new Menu;
        $menu->type = Menu::NAVIGATION;
        $menu->name = 'footer-menu';
        $menu->label = 'Footer Menu';
        $menu->location = Menu::FOOTER;
        $menu->status = Menu::ACTIVE;
        $menu->saveOrFail();

        $site->assignMenu($menu); // Add to site

        // Menu Items
        $items = [
            'Privacy Policy' => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'privacy',
                'title'     => 'Privacy Policy',
                'label'     => 'Privacy Policy',
                'url'       => '/page/privacy',
                'target'    => MenuItem::TARGET_SELF
            ],
            'Terms of Use' => [
                'type'      => MenuItem::PARENT_ITEM,
                'name'      => 'terms',
                'title'     => 'Terms of Use',
                'label'     => 'Terms of Use',
                'url'       => '/page/terms',
                'target'    => MenuItem::TARGET_SELF
            ]
        ];

        foreach ($items as $index => $item) {
            $menuItem = new MenuItem;
            $menuItem->type = $item['type'];
            $menuItem->name = $item['name'];
            $menuItem->title = $item['title'];
            $menuItem->label = $item['label'];
            $menuItem->url = $item['url'];
            $menuItem->target = $item['target'];
            if(isset($item['css_classes'])) {
                $menuItem->css_classes = $item['css_classes'];
            }
            $menuItem->saveOrFail();
            $menu->assignMenuItem($menuItem);
        }
    }
}
