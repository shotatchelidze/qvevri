<?php
class News_admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // public function getNews($this_page_first_result, $results_per_page, $language='en')
    public function getNews($this_page_first_result, $results_per_page)
    {
        $this->db->query("SELECT *
                        FROM news
                        -- where language=:language
                        where language=:language
                        ORDER BY news.created_at DESC
                        LIMIT :this_page_first_result, :results_per_page
                        ");

        $this->db->bind(':this_page_first_result', $this_page_first_result);
        $this->db->bind(':results_per_page', $results_per_page);
        $this->db->bind(':language', LANG);

        $result = $this->db->resultSet();

        foreach ($result as $r) :
            $this->db->query("SELECT *
            from news_imgs where news_id = :news_id");
            $this->db->bind(':news_id', $r->id);
            $img_result = $this->db->resultSet();
            $r->images = $img_result;
        endforeach;

        return $result;
    }


    public function getNewsById($item_id)
    {
        $this->db->query('SELECT * FROM news WHERE item_id = :item_id');
        // Bind value
        $this->db->bind(':item_id', $item_id);

        $results = $this->db->resultSet();
        return $results;
    }

    public function getImageName($item_id)
    {
        $this->db->query('SELECT news_img_name FROM news WHERE item_id = :item_id');
        $this->db->bind(':item_id', $item_id);
        $result = $this->db->single();
        return $result;
    }
    
    public function findNewsById($item_id){
        $this->db->query('SELECT news.item_id FROM news WHERE item_id = :item_id');
        $this->db->bind(':item_id', $item_id);
        $this->db->single();
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function addNews($data)
    {
          
        $insertOk = true;
        $i = 0;
        foreach (LANG_ARR as $lang => $language) {
            $this->db->query("INSERT INTO news (news_img_name,title,subtitle,text,language) VALUES (:news_img_name,:title,:subtitle,:text,:language)");

            $this->db->bind(':news_img_name', $data['news_img_name']);
            $this->db->bind(':title', $data["$lang" . '_title']);
            $this->db->bind(':subtitle', $data["$lang" . '_subtitle']);
            $this->db->bind(':text', $data["$lang" . '_text']);
            $this->db->bind(':language', $lang);
            if (!$this->db->execute()) {
                $insertOk = false;
                break;
            }
            $this->db->query('SELECT max(id) FROM news');
            $result = $this->db->singleColumn();
            // $result is last added news id, and $result-$i is item_id in news table.
            $this->db->query("UPDATE news SET item_id = $result-$i WHERE id = $result");
            if (!$this->db->execute()) {
                $insertOk = false;
                break;
            }
            $i++;
        }
        return $insertOk;
    }

    public function updateNews($data)
    {
        $updateOk = true;
        $i = 0;
        foreach (LANG_ARR as $lang => $language) {
            $this->db->query('UPDATE news SET news_img_name = :news_img_name, title = :title, subtitle = :subtitle, text = :text WHERE id = :id');

            $this->db->bind(':news_img_name', $data[$i]['news_img_name']);
            $this->db->bind(':title',$data[$i]["$lang".'_title']);
            $this->db->bind(':subtitle', $data[$i]["$lang".'_subtitle']);
            $this->db->bind(':text',$data[$i]["$lang".'_text']);
            $this->db->bind(':id',$data[$i]["$lang".'_id']);

            if(!$this->db->execute()){
                $updateOk = false;
            break;
            }
            $i++;
        }
        return $updateOk;
    }

    public function deleteNews($item_id)
    {
        $this->db->query('DELETE FROM news WHERE item_id = :item_id');
        // Bind value
        $this->db->bind(':item_id', $item_id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
