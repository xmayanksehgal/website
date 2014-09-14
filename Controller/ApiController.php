<?php
    
    namespace Controller;

    use \Model\SkillManager;
    use \Model\TranslationManager;
    use \Model\Skill;
    use \Utils\SecurityHelper;

    use \Everyman\Neo4j\Cypher\Query;
    use \Everyman\Neo4j\Relationship;
    use \Everyman\Neo4j\Traversal;

    /*
    [0] => testAction
    [1] => getRootNodeAction
    [2] => getNodeParentAction
    [3] => getNodeChildrenAction
    [4] => getNodeAction
    [5] => deleteSkillAction
    [6] => renameSkillAction
    [7] => searchNodeAction
    [9] => addSkillAction
    [10] => __construct
    */

    class ApiController extends Controller {
        
        /**
         * get the root "Skills" node
         */
        public function getRootNodeAction(){

            $skillManager = new SkillManager();
            $skill = $skillManager->findRootNode();
            
            $json = new \Model\JsonResponse();
            $json->setData($skill->getJsonData());
            $json->send();

        }

        /**
         * Returns node parent
         * 
         * @param int $id
         */
        public function getNodeParentAction($uuid){
            $skillManager = new SkillManager();
            $resultSet = $skillManager->findParentAndGrandParent($uuid);
            
            $ancestorsFound = $resultSet->count();
            if ($ancestorsFound == 0){
                $json = new \Model\JsonResponse("error", "No parent found");
                $json->send();
            }
            else if ($ancestorsFound >= 1){
                $parentNode = $resultSet[0]['parent'];
                $skill = new Skill( $parentNode );
            }

            $json = new \Model\JsonResponse();
            $json->setData( $skill->getJsonData() );
            $json->send();
        }

        /**
         * get first level children of a node, by its id
         */
        public function getNodeChildrenAction($uuid){

            $skillManager = new SkillManager();
            $resultSet = $skillManager->findChildren($uuid);
            
            $data = array();
            foreach ($resultSet as $row) {
                $skill = new Skill( $row['c'] );
                $data[] = $skill->getJsonData();
            }

            $json = new \Model\JsonResponse();
            $json->setData($data);
            $json->send();
        }

        /**
         * get one node by uuid
         */
        public function getNodeAction($uuid){
            
            $skillManager = new SkillManager();
            $skill = $skillManager->findByUuid($uuid);

            $json = new \Model\JsonResponse();
            $json->setData($skill->getJsonData());
            $json->send();

        }


        /**
         * get all nodes up to the root
         */
        public function getNodePathToRootAction($slug){
            
            $skillManager = new SkillManager();
            $path = $skillManager->findNodePathToRoot($slug);

            $json = new \Model\JsonResponse();
            $json->setData($path);
            $json->send();

        }

        /**
         * Deletes a node
         * @todo handle response correctly
         * @param string $uuid
         */
        function deleteSkillAction($uuid){

            $skillManager = new SkillManager();
            $deletionResult = $skillManager->delete($uuid);

            if ($deletionResult === true){
                $json = new \Model\JsonResponse(null, _("Node deleted."));
            }
            else {
                $json = new \Model\JsonResponse("error", $deletionResult);
            }
            $json->send();

        }


        /**
         * Translate a skill
         */
        function translateSkillAction($uuid){

            SecurityHelper::lock();

            if (!empty($_POST)){

                $skillTrans = $_POST['skillTrans'];
                $languageCode = $_POST['language'];
                $skillUuid = $_POST['skillUuid'];

                $validator = new \Model\Validator();
                $validator->validateSkillName($skillTrans);
                $validator->validateLanguageCode($languageCode);
                $validator->validateSkillUuid($skillUuid);

                if ($validator->isValid()){

                    $skillManager = new SkillManager();
                    $skill = $skillManager->findByUuid($skillUuid);

                    $translationManager = new TranslationManager();

                    //insert or update ?
                    $previousTranslationNode = $translationManager->findSkillTranslationInLanguage($skill, $languageCode);
                    
                    //insert
                    if (!$previousTranslationNode){
                        $translationManager->insertSkillTranslation($languageCode, $skillTrans, $skill);
                    }
                    //update
                    else {
                        $translationManager->updateSkillTranslation($skillTrans, $previousTranslationNode);
                    }

                }
                else {
                    print_r($validator->getErrors());   
                }
            }
        }

        /**
         * Rename a skill
         */
        function renameSkillAction($uuid){

            SecurityHelper::lock();

            if (!empty($_POST)){

                $skillName = $_POST['skillName'];
                $skillUuid = $_POST['skillUuid'];

                $validator = new \Model\Validator();
                $validator->validateSkillName($skillName);
                $validator->validateSkillUuid($skillUuid);

                if ($validator->isValid()){

                    $skillManager = new SkillManager();
                    $skill = $skillManager->findByUuid($skillUuid);

                    $previousName = $skill->getName();
                    $skill->setName( $skillName );

                    $skillManager->update($skill);

                    //add modifier skill relationship
                    $user = \Utils\SecurityHelper::getUser();
                    $userNode = $user->getNode();
                    $rel = $this->client->makeRelationship();
                    $rel->setStartNode($userNode)
                        ->setEndNode($skill->getNode())
                        ->setType('MODIFIED')
                        ->setProperty('date', date("Y-m-d H:i:s"))
                        ->setProperty('previousName', $previousName)
                        ->save();
                }
                else {
                    print_r($validator->getErrors());   
                }
            }
        }

        /**
         * Search by keywords
         */
        public function searchNodeAction($keywords){
            $keywords = urldecode($keywords);
            $searchIndex = new \Everyman\Neo4j\Index\NodeIndex($this->client, 'searches');
            $matches = $searchIndex->query('name:*'.strtolower($keywords).'*~');
            $data = array();
            foreach ($matches as $node) {
                $nodeParentRelationship = $node->getRelationships(
                    array('HAS'), Relationship::DirectionIn
                );

                $parentId = null;
                if (count($nodeParentRelationship) == 1){
                    $parentId = $nodeParentRelationship[0]->getStartNode()->getId();
                }
                $skill = new Skill( $node );
                $data[] = $skill->getJsonData();
            }

            $json = new \Model\JsonResponse();
            $json->setData($data);
            $json->send();
        }

        /**
         * delete all data then load dummy data
         */



        /**
         * Add a new skill
         */
        public function addSkillAction(){

            SecurityHelper::lock();

            if (!empty($_POST)){
                

                $skillName = $_POST['skillName'];
                $skillParentUuid = $_POST['skillParentUuid'];

                $validator = new \Model\Validator();
                $validator->validateSkillName($skillName);
                $validator->validateSkillParentUuid($skillParentUuid);

                $skillManager = new SkillManager();
                $parentNode = $skillManager->findByUuid( $skillParentUuid );

                
                if ($validator->isValid() && $parentNode){

                    $skill = new Skill();
                    $skill->setNewUuid();
                    $skill->setName($skillName);
                    $skill->setDepth( $parentNode->getDepth() + 1 );

                    $skillManager->save($skill, $skillParentUuid);

                    //add creator skill relationship
                    $userNode = $this->client->getNode($_SESSION['user']['id']);
                    $rel = $this->client->makeRelationship();
                    $rel->setStartNode($userNode)
                        ->setEndNode($skill->getNode())
                        ->setType('CREATED')->save();
                }
                else {
                    print_r($validator->getErrors());   
                }
            }
        }

    }