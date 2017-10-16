<section class="first">
    <div class="container">
        <img src="img/SKP-page-project-illus.png" id="project-illus" class="illus" />
        <h2 class="first"><?= _("THE PROJECT"); ?></h2>
        <h4>The Project</h4>
        <p>Humanity has been learning, individually and collectively, since the dawn of time. Over millenia, we have mastered an incredible number of skills. Yet, we still lack <b>a comprehensive and organized database of all human skills</b>.</p>
        <p>In this age of ambitious big data endeavours and advanced social tools, we firmly believe that it’s possible to map out all human skills. But the only smart way of doing so, is by leveraging collective knowledge and making as many people a part of the project as possible.</p>
        <h4>Our Mission</h4>
        <p>We aim to build the largest, most multilingual, most accurate skills database ever made by allowing <b>a diverse and skillful community</b> to contribute their individual skills to the global map.</p>
        <p>The crowdsourced data is free. Because the database is the result of many people's voluntary effort along with ours, we are finding ways to export the data and make an API through which users can get access to it. </p>
        <h4>How Can You Help?</h4>
        <p>In our simple structure, <b>each skill can be split into more specific sub-skills</b>. All you have to do is add your own skills in the most appropriate section. Your contribution will be reviewed and added to the database.</p>
        <p><a href="<?= \Controller\Router::url("graph"); ?>" alt="<?= _("The skills"); ?>">You can browse the skill database</a> right now. You don't need an account to do it.</p>
        <p>If you want to add your skills, you can <a class="register-link" href="<?= \Controller\Router::url("register"); ?>" title="<?= _("Register!"); ?>">sign up</a> in a matter of seconds. Add new skills and share your thoughts about existing ones.</p>
        <p>If you want to edit skills added by other users, you need to <a href="<?= \Controller\Router::url("apply"); ?>" title="<?= _("Become an Editor!"); ?>">apply to become an Editor</a>. Editor applications are reviewed so you can quickly become a full-fledged member of our growing community.</p>
        <p>If you want to meet the team or know how the Skill Project started, head straight for our <a href="<?= \Config\Config::VANILLA_URL?>" title="<?= _("Skill Project's Community"); ?>">community forum</a> and introduce yourself!</p>
    </div>
</section>
<hr />
<section>
    <div class="container">
        <h2><?= _("FAQ"); ?></h2>

        <h3><?=_("The Skills")?></h3>
        <div class="faq-q">
            <h4>What is a skill?</h4>
            <div class="faq-a">
                <p>It’s anything you can do, which is really important to you in your daily work, or in your life in general. Even seemingly trivial skills can be really important for some people.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Are there illegal skills?</h4>
            <div class="faq-a">
                <p>Every country has laws about what people can and cannot do. We do not consider that listing a skill which is illegal to perform in some countries should be illegal itself. However, Skill Project is not a place to promote openly illegal and/or immoral activities so expect the Editors to reject or flag inappropriate skills.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Is there a way to link directly to a skill?</h4>
            <div class="faq-a">
                <p>Sure! Open the Edit panel for any skill and click on “Share” for its URL address, that you can copy and paste anywhere. When you open the URL, the tree will automatically expand right up to the selected skill.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Is it possible for the same skill to exist in two (or more) different branches?</h4>
            <div class="faq-a">
                <p>Yes, absolutely. But as fas as the database is concerned, these will be two different skills (only with the same name). We believe that many skills could have different meanings based on their place in the database. Like “Photo Editing”, which could be classified under “Arts” as well as under “Computer Sciences” or “Technology”).</p>
            </div>
        </div>

        <div class="faq-q">
            <h4>Is something like “Breathing” or “Walking” considered a skill?</h4>
            <div class="faq-a">
                <p>Remember what we call a “skill” : </p>
                <q>
                    It’s anything you can do, which is important to you in your daily work, or in your life in general. Even seemingly trivial skills can be really important for some people.<br />
                </q>
                <p>
                    Ask a Yoga teacher if breathing is a skill. Sure it is! And what about Racewalking?<br />

                    So yes, they are skills. But if it’s not immediately obvious to you how, it may be better to leave adding one to someone who actually masters the skill, as these people are usually better at locating them correctly within the tree.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Is knowledge considered a skill in Skill Project?</h4>
            <div class="faq-a">
                <p>Generally, yes, because we have a broad definition of a skill that is not limited to physical actions. For example, we believe “Music” is a skill. A very general one, but still a concept that can relate to something one can learn, teach, master, excel at, etc. Of course, if you know Music, chances are you also know many sub-skills of Music.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Do skills have to be job/employment related?</h4>
            <div class="faq-a">
                <p>No, they don’t need to be related to a job. On the other hand, we struggled to think of any skill that was not at least partially connected to a job, if not for you, for someone else somewhere.</p>
            </div>
        </div>

        <h3><?=_("Editing the Skills")?></h3>
        <div class="faq-q">
            <h4>How do I add a skill?</h4>
            <div class="faq-a">
                <p>First, you must <a class="login-link" href="<?= \Controller\Router::url("login"); ?>" title="<?= _("Sign in!"); ?>">be logged in</a>. If you don’t yet have an account, head over to the <a class="register-link" href="<?= \Controller\Router::url("register"); ?>" title="<?= _("Register!"); ?>">Sign up form</a>.<br />
                Then, click on the “+” button on a skill that's related to the skill you want to add. This will open a panel with the “Create Skill” option.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Why do you limit the number of children a skill can have?</h4>
            <div class="faq-a">
                <p>If we didn’t, some skills would have hundreds or even thousands of sub-skills (think about the spoken languages for example). That wouldn’t make a very nice tree. Nor would it be easy to explore.<br />
                On the other hand, we noticed that it’s always possible to group skills together in such a way that the total number of skills in each group is always relatively small. This becomes obvious for skills you master because you can usually see that they naturally belong to different groups.<br />
                At the moment, we are limiting to 10 sub-skills, but we might slightly raise this limit in the future if it’s a problem. Do raise the issue on the <a href="<?= \Config\Config::VANILLA_URL?>" title="<?= _("Skill Project's Community"); ?>">community forum</a> if it’s bothering you.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Sometimes, I can rename, delete or move a skill around, and sometimes not. What’s going on?</h4>
            <div class="faq-a">
                <p>You have all editing rights on the skills you've just created, but only for one day... so review your work quickly!</p>
            </div>
        </div>

        <div class="faq-q">
            <h4>I need to edit a skill name, but I’m not an Editor… What can I do?</h4>
            <div class="faq-a">
                <p>If you just created the skill, you can edit it for one day. Otherwise, you can suggest the new name to an Editor by writing a message in the “Discuss the skill” section of the skill’s panel. Or you can <a href="<?= \Controller\Router::url("apply"); ?>" alt="<?= _("The skills"); ?>">apply to become an Editor yourself</a>!</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Why doesn’t everyone have Editor rights? Like on Wikipedia?</h4>
            <div class="faq-a">
                <p>Unfortunately, sometimes we have to plan for the worst. Wreaking havoc on the tree is just a few clicks away, when you have Editor rights. Because our data has an intrinsic hierarchical form, it is very easy to vandalize a few skills (on the top levels) for a very visible effect.<br />
                But we are constantly thinking about new and creative ways to moderate the system. If you have any ideas, we’ll be glad to hear from you on the <a href="<?= \Config\Config::VANILLA_URL?>" title="<?= _("Skill Project's Community"); ?>">community forum</a>.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Why is the background pink?</h4>
            <div class="faq-a">
                <p>It’s not “pink”, it’s “orchid”, you insensitive clod.</p>
            </div>
        </div>

        <h3><?=_("The Database")?></h3>
        <div class="faq-q">
            <h4>How many skills are there in the database?</h4>
            <div class="faq-a">
                <p>Skill Project started a few hundered skills. We expect the database to grow quickly into thousands of skills.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Where can I download the data?</h4>
            <div class="faq-a">
                <p>We are working on it! If it’s important to you, drop us a line so we can help you out.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Do you have a REST API?</h4>
            <div class="faq-a">
                <p>We are working on it! It might be comming soon. If you have any suggestions you can write that on the <a href="<?= \Config\Config::VANILLA_URL?>" title="<?= _("Skill Project's Community"); ?>">community forum</a> so we can discuss it together and see if it would come handy to more people. We will then reconsider our priorities.</p>
            </div>
        </div>

        <h3><?=_("Internationalization")?></h3>
        <div class="faq-q">
            <h4>What happens when I add a skill in French ? Is it copied to the English tree?</h4>
            <div class="faq-a">
                <p>When you add a skill to the tree, it's automatically translated into all supported languages. So it will appear in the English tree too. However, do not think of it as a copied skill because it is actually the exact same skill you added, only with a different (translated name). If you decide to move the skill within the database, you move it in all other languages simultaneously.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>Why is Skill Project not available in my language?</h4>
            <div class="faq-a">
                <p>We want Skill Project to be available in many, many languages. It's actually easy to translate the skills tree, but having the whole website available in those same languages takes a little more effort.<br />
                If you can help with the translation, we'd be grateful! Get in touch!</p>
            </div>
        </div>

        <h3><?=_("Our Mission")?></h3>
        <div class="faq-q">
            <h4>What’s the purpose of all this?</h4>
            <div class="faq-a">
                <p>It is to collectively create the largest and most accurate database of all human skills we, as humans, have learned in the last few millenia. And have it organized in such a way that we can easily explore it and keep it up to date.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>What's next for Skill Project?</h4>
            <div class="faq-a">
                <p>We believe our 21st century society is becoming more and more skill-centered, which is why we created Skill Project. We believe there will be many ways to leverage the power of a community-curated comprehensive skills database. We are eager to read what <em>you</em> think about it! Let’s talk about it in the <a href="<?= \Config\Config::VANILLA_URL?>" title="<?= _("Skill Project's Community"); ?>">community forum</a>.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>I’d like to make my own skill tree… any way I can do that?</h4>
            <div class="faq-a">
                <p>Not right now, but it’s a feature we have given some thought to. Care to discuss it on the community forum with us?</p>
            </div>
        </div>


        <h3><?=_("Becoming an Editor")?></h3>
        <div class="faq-q">
            <h4>How hard is it to become an Editor?</h4>
            <div class="faq-a">
                <p>It’s not hard, you just need to take a few minutes to fill in the <a href="<?= \Controller\Router::url("apply"); ?>" title="<?= _("Become an Editor!"); ?>">application form</a>. But we take care to only give Editor rights to people who take their application seriously. We don’t have an upper limit on the number of Editors the Skill Project can have, but we will encourage Editorship for branches of the tree that are not yet catered for.</p>
            </div>
        </div>
        <div class="faq-q">
            <h4>How many Editors are there?</h4>
            <div class="faq-a">
                <p>We started Skill Project a few Editors that were in the core team, but we expect more people to volunteer for this.</p>
            </div>
        </div>

        <script>
            $(".faq-q h4").on("click", function(){
                $(".faq-q h4.selected").not($(this)).removeClass("selected").next(".faq-a").slideToggle(300);
                $(this).toggleClass("selected");
                $(this).next(".faq-a").slideToggle(300);
            });
            $(".faq-a").hide();
        </script>   
    </div>
</section>
<hr />
<section>
    <div class="container">
        <h2><?= _("MEET THE FOUNDERS"); ?></h2>
        <p>Skill Project was brought to you by 3 friends living in Paris, France. Who passion for learning, teaching and experimenting which has naturally led us to come up with Skill Project. Come and chat with us in the <a href="<?= \Config\Config::VANILLA_URL?>" title="<?= _("Skill Project's Community"); ?>">community section</a>.
        </p>
        <div class="project-col">
            <div id="dario-pic" class="team-pic"></div>
            <h4>DARIO SPAGNOLO</h4>
            <p>Dario was born in Italy and from the age of 7 has been a self-taught computer enthusiast. He founded and ran a web agency in Paris for 7 years before Skill Project. He's also the founder of Open du Web, a regular event in Paris where web talents can show off their skills. Dario is furiously jealous of Guillaume’s nickname.</p>
        </div>
        <div class="project-col">
            <div id="guillaume-pic" class="team-pic"></div>
            <h4>GUILLAUME SYLVESTRE</h4>
            <p>Guillaume was born in Quebec, Canada and now lives in France. Passionate web developer and teacher, he fell in love with PHP and sexy databases some 8 years ago. He is known as SkillBill on the Skill Project.</p>
        </div>
        <div class="project-col">
            <div id="raphael-pic" class="team-pic"></div>
            <h4>RAPHAEL BOUSQUET</h4>
            <p>Raphael is french and just loves to speak latin, like this: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
        </div>
    </div>
</section>