<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RocksTableSeeder::class);
        $this->call(OrientationsTableSeeder::class);
        $this->call(SeasonsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AlbumsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(CragsTableSeeder::class);
        $this->call(DescriptionsTableSeeder::class);
        $this->call(LinksTableSeeder::class);
        $this->call(ParkingsTableSeeder::class);
        $this->call(RainExposuresTableSeeder::class);
        $this->call(SunsTableSeeder::class);
        $this->call(SectorsTableSeeder::class);
        $this->call(WordsTableSeeder::class);
        $this->call(ClimbsTableSeeder::class);
        $this->call(AnchorsTableSeeder::class);
        $this->call(PointsTableSeeder::class);
        $this->call(InclinesTableSeeder::class);
        $this->call(ReceptionsTableSeeder::class);
        $this->call(StartsTableSeeder::class);
        $this->call(RoutesTableSeeder::class);
        $this->call(RouteSectionsTableSeeder::class);
        $this->call(GapGradesTableSeeder::class);
        $this->call(ToposTableSeeder::class);
        $this->call(TopoCragsTableSeeder::class);
        $this->call(TopoSalesTableSeeder::class);
        $this->call(TopoWebsTableSeeder::class);
        $this->call(TopoPdfsTableSeeder::class);
        $this->call(MassivesTableSeeder::class);
        $this->call(MassiveCragsTableSeeder::class);
        $this->call(FollowsTableSeeder::class);
        $this->call(HelpsTableSeeder::class);
        $this->call(UserSettingsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(TickListsTableSeeder::class);
        $this->call(SocialNetworksTableSeeder::class);
        $this->call(UserSocialNetworksTableSeeder::class);
        $this->call(ConversationsTableSeeder::class);
        $this->call(UserConversationsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
