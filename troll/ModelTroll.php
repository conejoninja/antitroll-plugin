<?php
    /**
     * Model database for troll classes
     *
     * @package OSClass
     * @subpackage Model
     */
    class ModelTroll extends DAO
    {
        private static $instance ;
        public $aliases;

        public static function newInstance() {
            if( !self::$instance instanceof self ) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        function __construct() {
            parent::__construct();
            $this->setTableName("t_troll");
            $this->aliases = array();
        }

        public function import($file) {
            $path = osc_plugin_resource($file) ;
            $sql = file_get_contents($path);

            if(! $this->dao->importSQL($sql) ){
                throw new Exception( "Error importSQL::ModelTroll<br>".$file ) ;
            }
        }

        public function install() {

            $this->import('troll/struct.sql');

        }

        public function uninstall() {
            $this->dao->query(sprintf('DROP TABLE %s', $this->getTableName()));
        }

        public function listAll() {
            $this->dao->select('*') ;
            $this->dao->from($this->getTableName());
            $this->dao->orderBy('i_troll_id', 'ASC');
            $result = $this->dao->get();
            if(!$result) {
                return array();
            }
            return $result->result();
        }

        public function isTroll($user_id = 0, $ip = null, $email = null) {
            $trolls = array();
            $flag1 = $flag2 = $flag3 = true;
            if($user_id!=0) {
                $t = $this->findByValue($user_id);
                if($t!==false) { $trolls[] = $t; $flag1 = false; }
            }
            if($ip!=null) {
                $t = $this->findByValue($ip);
                if($t!==false) { $trolls[] = $t; $flag2 = false; }
            }
            if($email!=null) {
                $t = $this->findByValue($email);
                if($t!==false) { $trolls[] = $t; $flag3 = false; }
            }

            if(!empty($trolls)) {
                if(isset($trolls[1]) && $trolls[0]['i_troll_id']!=$trolls[1]['i_troll_id']) {
                    $this->dao->update($this->getTableName(), array('i_troll_id' => $trolls[0]['i_troll_id']), array('i_troll_id' => $trolls[1]['i_troll_id']));
                }
                if(isset($trolls[2]) && $trolls[0]['i_troll_id']!=$trolls[2]['i_troll_id'] && $trolls[1]['i_troll_id']!=$trolls[2]['i_troll_id']) {
                    $this->dao->update($this->getTableName(), array('i_troll_id' => $trolls[0]['i_troll_id']), array('i_troll_id' => $trolls[2]['i_troll_id']));
                }
                if($user_id!=0 && $flag1) {
                    $this->dao->insert($this->getTableName(), array('i_troll_id' => $trolls[0]['i_troll_id'], 's_value' => $user_id));
                }
                if($ip!=null && $flag2) {
                    $this->dao->insert($this->getTableName(), array('i_troll_id' => $trolls[0]['i_troll_id'], 's_value' => $ip));
                }
                if($email!=null && $flag3) {
                    $this->dao->insert($this->getTableName(), array('i_troll_id' => $trolls[0]['i_troll_id'], 's_value' => $email));
                }
                $this->aliases = $this->findByID($trolls[0]['i_troll_id']);

                return $trolls[0]['i_troll_id'];
            }
            return 0;
        }

        public function insertValue($id, $value) {
            $t = $this->findByValue($value);
            if($t===false) {
                $this->dao->insert($this->getTableName(), array('i_troll_id' => $id, 's_value' => $value));
            }
        }

        public function findByID($id) {
            $this->dao->select('*') ;
            $this->dao->from($this->getTableName());
            $this->dao->where('i_troll_id', $id);
            $result = $this->dao->get();
            if(!$result) {
                return array();
            }
            return $result->result();
        }

        public function findByValue($value) {
            $this->dao->select('*') ;
            $this->dao->from($this->getTableName());
            $this->dao->where('s_value', $value);
            $this->dao->limit(1);
            $result = $this->dao->get();
            if(!$result || $result->numRows()==0) {
                return false;
            }
            return $result->row();
        }

        public function findItemTypesByUserID($userId, $start = 0, $end = null, $itemType = false) {
            $this->dao->from(DB_TABLE_PREFIX."t_item");
            $this->dao->where("fk_i_user_id = $userId");

            if($itemType == 'active') {
                $this->dao->where('b_active', 1);
                $this->dao->where('dt_expiration > \'' . date('Y-m-d H:i:s') . '\'');

            } elseif($itemType == 'expired'){
                $this->dao->where('dt_expiration < \'' . date('Y-m-d H:i:s') . '\'');

            } elseif($itemType == 'pending_validate'){
                $this->dao->where('b_active', 0);

            } elseif($itemType == 'premium'){
                $this->dao->where('b_premium', 1);
            }

            $this->dao->orderBy('pk_i_id', 'DESC');
            if($end!=null) {
                $this->dao->limit($start, $end);
            } else if ($start > 0 ) {
                $this->dao->limit($start);
            }

            $result = $this->dao->get();
            if($result == false) {
                return array();
            }
            $items  = $result->result();
            return Item::newInstance()->extendData($items);
        }

        public function countItemTypesByUserID($userId, $itemType = false) {
            $this->dao->select('count(pk_i_id) as total');
            $this->dao->from(DB_TABLE_PREFIX."t_item");
            $this->dao->where("fk_i_user_id = $userId");
            $this->dao->orderBy('pk_i_id', 'DESC');

            if($itemType == 'active') {
                $this->dao->where('b_active', 1);
                $this->dao->where("dt_expiration > '" . date('Y-m-d H:i:s') . "'");

            } elseif($itemType == 'expired'){
                $this->dao->where("dt_expiration <= '" . date('Y-m-d H:i:s') . "'");

            } elseif($itemType == 'pending_validate'){
                $this->dao->where('b_active', 0);

            } elseif($itemType == 'premium'){
                $this->dao->where('b_premium', 1);
            }

            $result = $this->dao->get();
            if($result == false) {
                return array();
            }
            $items  = $result->row();
            return $items['total'];
        }

        function findCommentsByItemID($id, $trolls, $page = null, $commentsPerPage = null)
        {
            $result = array();
            if( $page == null ) { $page = osc_item_comments_page(); }
            if( $page == '' ) {
                $page = 0;
            } else if($page > 0) {
                $page = $page-1;
            }

            if( $commentsPerPage == null ) { $commentsPerPage = osc_comments_per_page(); }

            $this->dao->select();
            $this->dao->from(DB_TABLE_PREFIX."t_item_comment");
            $this->dao->where('fk_i_item_id', $id);
            $this->dao->where('b_active', 1);

            $aliases = array();
            foreach($trolls as $troll) {
                if(is_numeric($troll['s_value'])) {
                    $aliases[] = 'fk_i_user_id = '.$troll['s_value'];
                } else if(strpos($troll['s_value'], "@")!==false) {
                    $aliases[] = 's_author_email LIKE \''.$troll['s_value'].'\'';
                }
            }
            if(!empty($aliases)) {
                $this->dao->where(" ( b_enabled = 1 OR ( b_enabled = 0 AND ( ".implode(' OR ', $aliases)." )) ) ");
            }

            if( $page !== 'all' && $commentsPerPage > 0 ) {
                $this->dao->limit(($page*$commentsPerPage), $commentsPerPage);
            }

            $result = $this->dao->get();

            if($result == false) {
                return array();
            }

            return $result->result();
        }
    }

?>