<?php
class News_admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    

    public function getNews($this_page_first_result, $results_per_page)
    {
        $this->db->query("SELECT *, 
                        news.id as news_id,
                        news.news_img_name as news_img_name,
                        news_imgs.id as news_imgs_id,
                        news_imgs.news_id as news_imgs_news_id,
                        news_imgs.img_name as news_imgs_img_name 
                        FROM news
                        LEFT JOIN news_imgs
                        ON news.id = news_imgs.news_id
                        ORDER BY news.created_at DESC
                        LIMIT :this_page_first_result, :results_per_page
                        ");

        $this->db->bind(':this_page_first_result', $this_page_first_result);
        $this->db->bind(':results_per_page', $results_per_page);
        // $this->db->execute();

        $result = $this->db->resultSet();
        return $result;
    }


    public function getNewsById($id)
    {
        $this->db->query('SELECT * FROM news WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    // public function newsCount(){
    //     $this->db->query('SELECT count(*) FROM news');

    //     $count = $this->db->columnCount();
    //     return $count;
    // }

    public function newsCount()
    {
        $this->db->query('SELECT news.id FROM news');
        $this->db->resultSet();

        $count = $this->db->rowCount();
        return $count;
    }

    public function addNews($data)
    {
        $arr = implode(",", array_keys($data));
        $ArrVal = (':' . implode(", :", array_keys($data)));

        $this->db->query("INSERT INTO news ($arr) VALUES ($ArrVal)");

        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editNews($data)
    {
        $this->db->query('UPDATE news SET 
                            news_img_name = :news_img_name, 
                            en_title = :en_title, en_subtitle = :en_subtitle, en_text = :en_text,
                            ge_title = :ge_title, ge_subtitle = :ge_subtitle, ge_text = :ge_text,
                            ru_title = :ru_title, ru_subtitle = :ru_subtitle, ru_text = :ru_text
                            WHERE id = :id');
        // bind value
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':news_img_name', $data['news_img_name']);

        $this->db->bind(':en_title', $data['en_title']);
        $this->db->bind(':en_subtitle', $data['en_subtitle']);
        $this->db->bind(':en_text', $data['en_text']);

        $this->db->bind(':ge_title', $data['ge_title']);
        $this->db->bind(':ge_subtitle', $data['ge_subtitle']);
        $this->db->bind(':ge_text', $data['ge_text']);

        $this->db->bind(':ru_title', $data['ru_title']);
        $this->db->bind(':ru_subtitle', $data['ru_subtitle']);
        $this->db->bind(':ru_text', $data['ru_text']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNews($id)
    {
        $this->db->query('DELETE FROM news WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
