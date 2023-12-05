<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table   = 'video';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->video = $db->table('video');
    }

    // --- video ---
    public function get_video($order = NULL, $limit = NULL, $playlist = NULL)
    {
        $builder = $this->video;
        $builder->select('video.*,playlist.nm_playlist');
        $builder->join('playlist', 'playlist.id_playlist=video.playlist_id', 'left');
        if ($playlist != NULL) {
            $builder->where('video.playlist_id', $playlist);
        }
        if ($order == NULL) {
            $builder->orderBy('video.id_video', 'DESC');
        } else {
            $builder->orderBy('video.id_video', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    // --- video dengan pagination ---
    public function get_all_video($pagination)
    {
        return $this->select('video.*, playlist.nm_playlist')
            ->join('playlist', 'playlist.id_playlist=video.playlist_id')
            ->orderBy('video.id_video', 'DESC')
            ->paginate($pagination);
    }

    public function get_video_by_id($id, $seo = NULL)
    {
        $builder = $this->video;
        $builder->select('video.*,playlist.nm_playlist');
        $builder->join('playlist', 'playlist.id_playlist=video.playlist_id', 'left');
        $builder->where('video.id_video', $id);
        if ($seo != NULL) {
            $builder->where('video.video_seo', $seo);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_video_where($data)
    {
        $builder = $this->video;
        $builder->select('video.*,playlist.nm_playlist');
        $builder->join('playlist', 'playlist.id_playlist=video.playlist_id', 'left');
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    public function save_video($data)
    {
        return $this->video->insert($data);
    }

    public function update_video($data, $id)
    {
        $builder = $this->video;
        $builder->where('id_video', $id);
        return $builder->update($data);
    }

    public function delete_video($id)
    {
        $builder = $this->video;
        $builder->where('id_video', $id);
        return $builder->delete();
    }
}
