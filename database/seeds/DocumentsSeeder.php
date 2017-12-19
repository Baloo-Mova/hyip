<?php

use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\Documents::truncate();
            \App\Models\Documents::insert([
                [
                    'title' => 'Документы',
                    'content' => '<h4 id="term_of_use">Пользовательское соглашение</h4>

<p>Aenean vitae sapien sit amet est lobortis finibus lobortis eget justo. Etiam lacus nunc, semper non elementum sed, consequat sed lacus. Etiam ac lorem at justo aliquam maximus quis in nisi. Ut imperdiet egestas tempor. Suspendisse potenti. Suspendisse potenti. Mauris pellentesque magna a enim maximus, bibendum accumsan orci pretium. Fusce viverra diam in arcu luctus finibus. Vestibulum vel porttitor ipsum. Nam tristique scelerisque libero eu tristique. Etiam vel nulla tellus. Nullam ut rutrum magna. Donec malesuada orci id erat luctus, quis lacinia magna aliquet.

Aenean auctor ultricies viverra. Aenean vestibulum quis ipsum non commodo. Quisque dapibus sem a dignissim rutrum. Nullam est leo, sollicitudin et justo vel, fermentum ornare tortor. Quisque porttitor eros in mollis hendrerit. Nulla id mattis nunc. Duis faucibus tempor fringilla. Pellentesque euismod nibh enim, ac lobortis sapien hendrerit eu. Morbi vel ante laoreet, laoreet velit ac, elementum nisi. Vestibulum in aliquam ligula, id pellentesque sem. Phasellus posuere augue ex, id sollicitudin massa elementum ac. Aliquam nec enim iaculis, sodales sem sit amet, molestie sapien. Mauris sit amet finibus neque. In hac habitasse platea dictumst. Praesent in convallis nisi.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit orci quis est malesuada, ut sagittis tellus rutrum. Proin dignissim massa in fermentum pulvinar. Aliquam tempus nunc justo, gravida elementum magna bibendum quis. Suspendisse bibendum ante lectus, id tempor velit sodales in. Curabitur sollicitudin purus felis, eget ultricies tortor congue et. In viverra rhoncus mollis. Nullam id diam maximus, facilisis magna eu, sagittis lorem. Integer faucibus ullamcorper tristique. Curabitur consectetur nulla nec quam maximus, et congue arcu consequat. Integer molestie tellus et nibh viverra, non posuere diam volutpat. Integer euismod fermentum leo vitae dignissim. Cras sed posuere odio. Mauris sit amet consequat mauris.

Nunc ut tincidunt elit, sed faucibus velit. Curabitur eu maximus risus, ut varius tortor. Duis mattis ex eget libero facilisis ornare. Donec neque ligula, feugiat nec hendrerit non, fermentum et risus. In hac habitasse platea dictumst. Donec commodo sagittis dui rutrum faucibus. In fermentum vitae nisl eget maximus. Quisque vel orci congue, placerat diam eu, interdum massa. Vivamus dignissim laoreet sem et pulvinar. Sed sed lobortis sapien, vitae cursus turpis. Cras euismod varius ante, pharetra condimentum neque porttitor non. Sed lacinia justo finibus, viverra magna ac, feugiat urna.</p>

<h4 id="rules">Правила</h4>

<p>Aenean vitae sapien sit amet est lobortis finibus lobortis eget justo. Etiam lacus nunc, semper non elementum sed, consequat sed lacus. Etiam ac lorem at justo aliquam maximus quis in nisi. Ut imperdiet egestas tempor. Suspendisse potenti. Suspendisse potenti. Mauris pellentesque magna a enim maximus, bibendum accumsan orci pretium. Fusce viverra diam in arcu luctus finibus. Vestibulum vel porttitor ipsum. Nam tristique scelerisque libero eu tristique. Etiam vel nulla tellus. Nullam ut rutrum magna. Donec malesuada orci id erat luctus, quis lacinia magna aliquet.

Aenean auctor ultricies viverra. Aenean vestibulum quis ipsum non commodo. Quisque dapibus sem a dignissim rutrum. Nullam est leo, sollicitudin et justo vel, fermentum ornare tortor. Quisque porttitor eros in mollis hendrerit. Nulla id mattis nunc. Duis faucibus tempor fringilla. Pellentesque euismod nibh enim, ac lobortis sapien hendrerit eu. Morbi vel ante laoreet, laoreet velit ac, elementum nisi. Vestibulum in aliquam ligula, id pellentesque sem. Phasellus posuere augue ex, id sollicitudin massa elementum ac. Aliquam nec enim iaculis, sodales sem sit amet, molestie sapien. Mauris sit amet finibus neque. In hac habitasse platea dictumst. Praesent in convallis nisi.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit orci quis est malesuada, ut sagittis tellus rutrum. Proin dignissim massa in fermentum pulvinar. Aliquam tempus nunc justo, gravida elementum magna bibendum quis. Suspendisse bibendum ante lectus, id tempor velit sodales in. Curabitur sollicitudin purus felis, eget ultricies tortor congue et. In viverra rhoncus mollis. Nullam id diam maximus, facilisis magna eu, sagittis lorem. Integer faucibus ullamcorper tristique. Curabitur consectetur nulla nec quam maximus, et congue arcu consequat. Integer molestie tellus et nibh viverra, non posuere diam volutpat. Integer euismod fermentum leo vitae dignissim. Cras sed posuere odio. Mauris sit amet consequat mauris.

Nunc ut tincidunt elit, sed faucibus velit. Curabitur eu maximus risus, ut varius tortor. Duis mattis ex eget libero facilisis ornare. Donec neque ligula, feugiat nec hendrerit non, fermentum et risus. In hac habitasse platea dictumst. Donec commodo sagittis dui rutrum faucibus. In fermentum vitae nisl eget maximus. Quisque vel orci congue, placerat diam eu, interdum massa. Vivamus dignissim laoreet sem et pulvinar. Sed sed lobortis sapien, vitae cursus turpis. Cras euismod varius ante, pharetra condimentum neque porttitor non. Sed lacinia justo finibus, viverra magna ac, feugiat urna.</p>',
                    'is_active' => 1,
                    'lang' => 'ru',
                ],
                [
                    'title' => 'Documents',
                    'content' => '<h4 id="term_of_use">Terms of use</h4>

<p>text</p>

<h4 id="rules">Rules</h4>

<p>Rules text</p>',
                    'is_active' => 1,
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
