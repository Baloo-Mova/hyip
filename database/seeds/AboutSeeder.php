<?php

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\About::truncate();
            \App\Models\About::insert([
                [
                    'title' => 'О компании',
                    'uri' => 'o-kompanii',
                    'content' => '<h4 id="what">Что такое White Coin?</h4>
                    
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel eleifend orci, nec tincidunt risus. Curabitur hendrerit mauris pellentesque mollis imperdiet. In porta diam non nulla venenatis, non pharetra libero auctor. Fusce sollicitudin consectetur quam, non interdum orci rutrum sed. Mauris pretium non lacus at suscipit. Praesent lobortis eros sit amet dolor iaculis tincidunt. Quisque lacinia dictum felis ut aliquam. Morbi faucibus vulputate felis nec malesuada. Aenean rutrum tristique libero nec sodales. Curabitur et risus diam. Vivamus nec consectetur elit, ac fringilla justo. Vivamus quis lorem elementum, dictum justo in, mattis enim. Morbi posuere, tortor vitae feugiat consectetur, nunc nunc gravida eros, quis ornare libero metus sed mi. Aenean sagittis, odio a dapibus placerat, quam orci venenatis tortor, et pellentesque elit sapien vitae tellus. Maecenas rutrum euismod orci vel vestibulum. Proin lacinia scelerisque imperdiet.</p>

<p>Cras luctus, arcu vel pretium dignissim, justo justo lobortis neque, non sollicitudin odio lorem at mi. Integer sollicitudin eros non nisl ornare gravida at ac justo. Sed tincidunt pulvinar dolor at elementum. Etiam nec felis non mauris vestibulum viverra commodo ut tellus. Nullam a aliquet ipsum. Ut molestie iaculis faucibus. Sed nunc augue, laoreet vitae ante ut, elementum congue eros. Vivamus consectetur sem eu magna hendrerit dictum. Aliquam eu tellus a nibh vehicula tincidunt.</p>

<h4 id="how_we_work">Как мы работаем?</h4>

<p>Maecenas non efficitur augue. Curabitur non lacus lorem. Etiam accumsan, nibh a tempor scelerisque, ligula elit hendrerit enim, eu tempor leo lectus sed dolor. Maecenas sagittis sodales tellus, eu pulvinar neque volutpat sed. Nunc maximus maximus risus, in vestibulum dui sollicitudin a. Vivamus iaculis odio ut quam tempus mattis. Aliquam gravida lectus non justo cursus viverra. Proin libero est, rhoncus at mauris nec, varius dictum lacus. Nam finibus hendrerit iaculis. Vestibulum consequat cursus nibh, a fringilla lacus ultrices nec. In leo lacus, rutrum et pretium vel, fermentum ut sem. Vestibulum elementum ipsum et risus pretium, a molestie tellus aliquet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi porta sed sapien eget elementum.</p>

<p>Aliquam at sem eros. Aliquam tincidunt elit sed leo dapibus mollis. Integer viverra vitae orci sit amet dignissim. Sed a luctus nibh. Donec id velit eget magna cursus pretium eu sit amet lacus. Curabitur vitae lorem imperdiet, pharetra purus vel, rutrum nisi. Phasellus tempor varius elementum. Vestibulum sit amet velit id velit suscipit fermentum eget sed dolor. Aliquam erat nisl, semper eu elementum eu, pharetra vel enim. Mauris ultricies dolor ut massa vehicula ornare. Sed hendrerit nunc ut accumsan tempor. Nulla at eleifend nisl. Duis dignissim id dui id venenatis. Nam sit amet sapien eget tortor malesuada tempus.</p>

<h4 id="our_targets">Наши цели</h4>

<p>In tincidunt dictum lacus, eget pellentesque diam auctor et. Aenean sed suscipit elit. Phasellus id placerat justo. Proin bibendum urna sed tellus suscipit, interdum laoreet ipsum maximus. Donec at ex non dolor blandit porttitor. Cras pretium turpis eu tortor rutrum bibendum. Donec enim ligula, suscipit sit amet elit a, auctor sollicitudin justo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras sit amet dignissim quam. Praesent purus lectus, dapibus nec ante vitae, sollicitudin tincidunt nisl. Morbi vestibulum semper gravida.</p>

<p>Phasellus ac congue quam. Vestibulum fringilla ipsum euismod augue porta mattis. Nunc a maximus velit. Donec non congue nisl. Vivamus eu nisl a sapien laoreet aliquet sit amet in sapien. Fusce tincidunt, diam sed venenatis varius, justo purus maximus sapien, at tempus sapien odio vitae eros. Vivamus tristique nulla quis risus suscipit, quis consequat lectus efficitur. Mauris a turpis at neque facilisis pretium sit amet sed nunc. Donec a pretium elit. Aenean dui dolor, laoreet nec urna non, faucibus sollicitudin nulla. Aenean ultricies velit nibh, vitae mattis enim lacinia eu. Maecenas vel lobortis dolor. Maecenas at dolor a magna eleifend porta ut vel nisl. Proin vitae elit tempus, fringilla est non, sagittis nulla.</p>

<h4 id="why_we">Почему мы?</h4>

<p>Aenean vitae sapien sit amet est lobortis finibus lobortis eget justo. Etiam lacus nunc, semper non elementum sed, consequat sed lacus. Etiam ac lorem at justo aliquam maximus quis in nisi. Ut imperdiet egestas tempor. Suspendisse potenti. Suspendisse potenti. Mauris pellentesque magna a enim maximus, bibendum accumsan orci pretium. Fusce viverra diam in arcu luctus finibus. Vestibulum vel porttitor ipsum. Nam tristique scelerisque libero eu tristique. Etiam vel nulla tellus. Nullam ut rutrum magna. Donec malesuada orci id erat luctus, quis lacinia magna aliquet.</p>

<p>Aenean auctor ultricies viverra. Aenean vestibulum quis ipsum non commodo. Quisque dapibus sem a dignissim rutrum. Nullam est leo, sollicitudin et justo vel, fermentum ornare tortor. Quisque porttitor eros in mollis hendrerit. Nulla id mattis nunc. Duis faucibus tempor fringilla. Pellentesque euismod nibh enim, ac lobortis sapien hendrerit eu. Morbi vel ante laoreet, laoreet velit ac, elementum nisi. Vestibulum in aliquam ligula, id pellentesque sem. Phasellus posuere augue ex, id sollicitudin massa elementum ac. Aliquam nec enim iaculis, sodales sem sit amet, molestie sapien. Mauris sit amet finibus neque. In hac habitasse platea dictumst. Praesent in convallis nisi.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit orci quis est malesuada, ut sagittis tellus rutrum. Proin dignissim massa in fermentum pulvinar. Aliquam tempus nunc justo, gravida elementum magna bibendum quis. Suspendisse bibendum ante lectus, id tempor velit sodales in. Curabitur sollicitudin purus felis, eget ultricies tortor congue et. In viverra rhoncus mollis. Nullam id diam maximus, facilisis magna eu, sagittis lorem. Integer faucibus ullamcorper tristique. Curabitur consectetur nulla nec quam maximus, et congue arcu consequat. Integer molestie tellus et nibh viverra, non posuere diam volutpat. Integer euismod fermentum leo vitae dignissim. Cras sed posuere odio. Mauris sit amet consequat mauris.</p>

<p>Nunc ut tincidunt elit, sed faucibus velit. Curabitur eu maximus risus, ut varius tortor. Duis mattis ex eget libero facilisis ornare. Donec neque ligula, feugiat nec hendrerit non, fermentum et risus. In hac habitasse platea dictumst. Donec commodo sagittis dui rutrum faucibus. In fermentum vitae nisl eget maximus. Quisque vel orci congue, placerat diam eu, interdum massa. Vivamus dignissim laoreet sem et pulvinar. Sed sed lobortis sapien, vitae cursus turpis. Cras euismod varius ante, pharetra condimentum neque porttitor non. Sed lacinia justo finibus, viverra magna ac, feugiat urna.</p>

<h4 id="how_earn">Как зарабатывать?</h4>

<p>Aenean vitae sapien sit amet est lobortis finibus lobortis eget justo. Etiam lacus nunc, semper non elementum sed, consequat sed lacus. Etiam ac lorem at justo aliquam maximus quis in nisi. Ut imperdiet egestas tempor. Suspendisse potenti. Suspendisse potenti. Mauris pellentesque magna a enim maximus, bibendum accumsan orci pretium. Fusce viverra diam in arcu luctus finibus. Vestibulum vel porttitor ipsum. Nam tristique scelerisque libero eu tristique. Etiam vel nulla tellus. Nullam ut rutrum magna. Donec malesuada orci id erat luctus, quis lacinia magna aliquet.</p>

<p>Aenean auctor ultricies viverra. Aenean vestibulum quis ipsum non commodo. Quisque dapibus sem a dignissim rutrum. Nullam est leo, sollicitudin et justo vel, fermentum ornare tortor. Quisque porttitor eros in mollis hendrerit. Nulla id mattis nunc. Duis faucibus tempor fringilla. Pellentesque euismod nibh enim, ac lobortis sapien hendrerit eu. Morbi vel ante laoreet, laoreet velit ac, elementum nisi. Vestibulum in aliquam ligula, id pellentesque sem. Phasellus posuere augue ex, id sollicitudin massa elementum ac. Aliquam nec enim iaculis, sodales sem sit amet, molestie sapien. Mauris sit amet finibus neque. In hac habitasse platea dictumst. Praesent in convallis nisi.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit orci quis est malesuada, ut sagittis tellus rutrum. Proin dignissim massa in fermentum pulvinar. Aliquam tempus nunc justo, gravida elementum magna bibendum quis. Suspendisse bibendum ante lectus, id tempor velit sodales in. Curabitur sollicitudin purus felis, eget ultricies tortor congue et. In viverra rhoncus mollis. Nullam id diam maximus, facilisis magna eu, sagittis lorem. Integer faucibus ullamcorper tristique. Curabitur consectetur nulla nec quam maximus, et congue arcu consequat. Integer molestie tellus et nibh viverra, non posuere diam volutpat. Integer euismod fermentum leo vitae dignissim. Cras sed posuere odio. Mauris sit amet consequat mauris.</p>',
                    'img' => 'noimg.jpg',
                    'is_active' => 1,
                    'lang' => 'ru',
                ],
                [
                    'title' => 'About company',
                    'uri' => 'o-kompanii',
                    'content' => '<h4 id="what">What is White Coin?</h4>
                    
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel eleifend orci, nec tincidunt risus. Curabitur hendrerit mauris pellentesque mollis imperdiet. In porta diam non nulla venenatis, non pharetra libero auctor. Fusce sollicitudin consectetur quam, non interdum orci rutrum sed. Mauris pretium non lacus at suscipit. Praesent lobortis eros sit amet dolor iaculis tincidunt. Quisque lacinia dictum felis ut aliquam. Morbi faucibus vulputate felis nec malesuada. Aenean rutrum tristique libero nec sodales. Curabitur et risus diam. Vivamus nec consectetur elit, ac fringilla justo. Vivamus quis lorem elementum, dictum justo in, mattis enim. Morbi posuere, tortor vitae feugiat consectetur, nunc nunc gravida eros, quis ornare libero metus sed mi. Aenean sagittis, odio a dapibus placerat, quam orci venenatis tortor, et pellentesque elit sapien vitae tellus. Maecenas rutrum euismod orci vel vestibulum. Proin lacinia scelerisque imperdiet.</p>

<p>Cras luctus, arcu vel pretium dignissim, justo justo lobortis neque, non sollicitudin odio lorem at mi. Integer sollicitudin eros non nisl ornare gravida at ac justo. Sed tincidunt pulvinar dolor at elementum. Etiam nec felis non mauris vestibulum viverra commodo ut tellus. Nullam a aliquet ipsum. Ut molestie iaculis faucibus. Sed nunc augue, laoreet vitae ante ut, elementum congue eros. Vivamus consectetur sem eu magna hendrerit dictum. Aliquam eu tellus a nibh vehicula tincidunt.</p>

<h4 id="how_we_work">How we are working?</h4>

<p>Maecenas non efficitur augue. Curabitur non lacus lorem. Etiam accumsan, nibh a tempor scelerisque, ligula elit hendrerit enim, eu tempor leo lectus sed dolor. Maecenas sagittis sodales tellus, eu pulvinar neque volutpat sed. Nunc maximus maximus risus, in vestibulum dui sollicitudin a. Vivamus iaculis odio ut quam tempus mattis. Aliquam gravida lectus non justo cursus viverra. Proin libero est, rhoncus at mauris nec, varius dictum lacus. Nam finibus hendrerit iaculis. Vestibulum consequat cursus nibh, a fringilla lacus ultrices nec. In leo lacus, rutrum et pretium vel, fermentum ut sem. Vestibulum elementum ipsum et risus pretium, a molestie tellus aliquet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi porta sed sapien eget elementum.</p>

<p>Aliquam at sem eros. Aliquam tincidunt elit sed leo dapibus mollis. Integer viverra vitae orci sit amet dignissim. Sed a luctus nibh. Donec id velit eget magna cursus pretium eu sit amet lacus. Curabitur vitae lorem imperdiet, pharetra purus vel, rutrum nisi. Phasellus tempor varius elementum. Vestibulum sit amet velit id velit suscipit fermentum eget sed dolor. Aliquam erat nisl, semper eu elementum eu, pharetra vel enim. Mauris ultricies dolor ut massa vehicula ornare. Sed hendrerit nunc ut accumsan tempor. Nulla at eleifend nisl. Duis dignissim id dui id venenatis. Nam sit amet sapien eget tortor malesuada tempus.</p>

<h4 id="our_targets">Our goals</h4>

<p>In tincidunt dictum lacus, eget pellentesque diam auctor et. Aenean sed suscipit elit. Phasellus id placerat justo. Proin bibendum urna sed tellus suscipit, interdum laoreet ipsum maximus. Donec at ex non dolor blandit porttitor. Cras pretium turpis eu tortor rutrum bibendum. Donec enim ligula, suscipit sit amet elit a, auctor sollicitudin justo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras sit amet dignissim quam. Praesent purus lectus, dapibus nec ante vitae, sollicitudin tincidunt nisl. Morbi vestibulum semper gravida.</p>

<p>Phasellus ac congue quam. Vestibulum fringilla ipsum euismod augue porta mattis. Nunc a maximus velit. Donec non congue nisl. Vivamus eu nisl a sapien laoreet aliquet sit amet in sapien. Fusce tincidunt, diam sed venenatis varius, justo purus maximus sapien, at tempus sapien odio vitae eros. Vivamus tristique nulla quis risus suscipit, quis consequat lectus efficitur. Mauris a turpis at neque facilisis pretium sit amet sed nunc. Donec a pretium elit. Aenean dui dolor, laoreet nec urna non, faucibus sollicitudin nulla. Aenean ultricies velit nibh, vitae mattis enim lacinia eu. Maecenas vel lobortis dolor. Maecenas at dolor a magna eleifend porta ut vel nisl. Proin vitae elit tempus, fringilla est non, sagittis nulla.</p>

<h4 id="why_we">Why we?</h4>

<p>Aenean vitae sapien sit amet est lobortis finibus lobortis eget justo. Etiam lacus nunc, semper non elementum sed, consequat sed lacus. Etiam ac lorem at justo aliquam maximus quis in nisi. Ut imperdiet egestas tempor. Suspendisse potenti. Suspendisse potenti. Mauris pellentesque magna a enim maximus, bibendum accumsan orci pretium. Fusce viverra diam in arcu luctus finibus. Vestibulum vel porttitor ipsum. Nam tristique scelerisque libero eu tristique. Etiam vel nulla tellus. Nullam ut rutrum magna. Donec malesuada orci id erat luctus, quis lacinia magna aliquet.</p>

<p>Aenean auctor ultricies viverra. Aenean vestibulum quis ipsum non commodo. Quisque dapibus sem a dignissim rutrum. Nullam est leo, sollicitudin et justo vel, fermentum ornare tortor. Quisque porttitor eros in mollis hendrerit. Nulla id mattis nunc. Duis faucibus tempor fringilla. Pellentesque euismod nibh enim, ac lobortis sapien hendrerit eu. Morbi vel ante laoreet, laoreet velit ac, elementum nisi. Vestibulum in aliquam ligula, id pellentesque sem. Phasellus posuere augue ex, id sollicitudin massa elementum ac. Aliquam nec enim iaculis, sodales sem sit amet, molestie sapien. Mauris sit amet finibus neque. In hac habitasse platea dictumst. Praesent in convallis nisi.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit orci quis est malesuada, ut sagittis tellus rutrum. Proin dignissim massa in fermentum pulvinar. Aliquam tempus nunc justo, gravida elementum magna bibendum quis. Suspendisse bibendum ante lectus, id tempor velit sodales in. Curabitur sollicitudin purus felis, eget ultricies tortor congue et. In viverra rhoncus mollis. Nullam id diam maximus, facilisis magna eu, sagittis lorem. Integer faucibus ullamcorper tristique. Curabitur consectetur nulla nec quam maximus, et congue arcu consequat. Integer molestie tellus et nibh viverra, non posuere diam volutpat. Integer euismod fermentum leo vitae dignissim. Cras sed posuere odio. Mauris sit amet consequat mauris.</p>

<p>Nunc ut tincidunt elit, sed faucibus velit. Curabitur eu maximus risus, ut varius tortor. Duis mattis ex eget libero facilisis ornare. Donec neque ligula, feugiat nec hendrerit non, fermentum et risus. In hac habitasse platea dictumst. Donec commodo sagittis dui rutrum faucibus. In fermentum vitae nisl eget maximus. Quisque vel orci congue, placerat diam eu, interdum massa. Vivamus dignissim laoreet sem et pulvinar. Sed sed lobortis sapien, vitae cursus turpis. Cras euismod varius ante, pharetra condimentum neque porttitor non. Sed lacinia justo finibus, viverra magna ac, feugiat urna.</p>

<h4 id="how_earn">How to earn?</h4>

<p>Aenean vitae sapien sit amet est lobortis finibus lobortis eget justo. Etiam lacus nunc, semper non elementum sed, consequat sed lacus. Etiam ac lorem at justo aliquam maximus quis in nisi. Ut imperdiet egestas tempor. Suspendisse potenti. Suspendisse potenti. Mauris pellentesque magna a enim maximus, bibendum accumsan orci pretium. Fusce viverra diam in arcu luctus finibus. Vestibulum vel porttitor ipsum. Nam tristique scelerisque libero eu tristique. Etiam vel nulla tellus. Nullam ut rutrum magna. Donec malesuada orci id erat luctus, quis lacinia magna aliquet.</p>

<p>Aenean auctor ultricies viverra. Aenean vestibulum quis ipsum non commodo. Quisque dapibus sem a dignissim rutrum. Nullam est leo, sollicitudin et justo vel, fermentum ornare tortor. Quisque porttitor eros in mollis hendrerit. Nulla id mattis nunc. Duis faucibus tempor fringilla. Pellentesque euismod nibh enim, ac lobortis sapien hendrerit eu. Morbi vel ante laoreet, laoreet velit ac, elementum nisi. Vestibulum in aliquam ligula, id pellentesque sem. Phasellus posuere augue ex, id sollicitudin massa elementum ac. Aliquam nec enim iaculis, sodales sem sit amet, molestie sapien. Mauris sit amet finibus neque. In hac habitasse platea dictumst. Praesent in convallis nisi.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit orci quis est malesuada, ut sagittis tellus rutrum. Proin dignissim massa in fermentum pulvinar. Aliquam tempus nunc justo, gravida elementum magna bibendum quis. Suspendisse bibendum ante lectus, id tempor velit sodales in. Curabitur sollicitudin purus felis, eget ultricies tortor congue et. In viverra rhoncus mollis. Nullam id diam maximus, facilisis magna eu, sagittis lorem. Integer faucibus ullamcorper tristique. Curabitur consectetur nulla nec quam maximus, et congue arcu consequat. Integer molestie tellus et nibh viverra, non posuere diam volutpat. Integer euismod fermentum leo vitae dignissim. Cras sed posuere odio. Mauris sit amet consequat mauris.</p>',
                    'img' => 'noimg.jpg',
                    'is_active' => 1,
                    'lang' => 'en',
                ],
            ]);
        } catch (Exception $ex) {
        }
    }
}
