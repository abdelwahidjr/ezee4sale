<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UserSettingsTableSeeder::class);
        $this->call(SiteSettingsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(FAQsTableSeeder::class);
        $this->call(AdsTableSeeder::class);
        $this->call(PopupsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(OutletsTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(NewslettersTableSeeder::class);
        $this->call(ContactUsTableSeeder::class);
        $this->call(ContactUsMessagesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ExtrasTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(PromotionsTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
        $this->call(GiftCardsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(CartsTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(OutletAreasTableSeeder::class);
        $this->call(SubOrdersTableSeeder::class);
        $this->call(FriendshipsTableSeeder::class);

        $this->call(CitiesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(FriendsTableSeeder::class);
    }
}
