<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlbumModel;
use App\Models\FotoModel;
use App\Models\PlaylistModel;
use App\Models\VideoModel;

class Galeri extends BaseController
{
    public function __construct()
    {
        $this->AlbumModel = new AlbumModel();
        $this->FotoModel = new FotoModel();
        $this->PlaylistModel = new PlaylistModel();
        $this->VideoModel = new VideoModel();
    }

    public function index()
    {
        $data['title'] = 'Album Foto';
        $data['album'] = $this->AlbumModel->where('aktif', 'Y')->orderBy('id_album', 'DESC')->paginate(12);
        $data['pager'] = $this->AlbumModel->pager;
        $data['jAlbum'] = count($data['album']);
        return view('frontend/' . templates()->folder . '/galeri/index', $data);
    }

    public function album_detail($a, $b)
    {
        $album = $this->AlbumModel->get_album_by_id($a);
        $data['title'] = 'Galeri Foto ' . $album->nm_album;
        $data['foto'] = $this->FotoModel->where('album_id', $a)->orderBy('id_foto', 'DESC')->paginate(16);
        $data['pager'] = $this->FotoModel->pager;
        $data['album'] = $this->AlbumModel->get_album_where(['id_album !=' => $a, 'aktif' => 'Y'], NULL, 3);
        $data['jAlbum'] = count($data['album']);
        return view('frontend/' . templates()->folder . '/galeri/album_detail', $data);
    }

    // Playlist Video
    public function playlist()
    {
        $data['title'] = 'Playlist Video';
        $data['playlist'] = $this->PlaylistModel->where('aktif', 'Y')->orderBy('id_playlist', 'DESC')->paginate(12);
        $data['pager'] = $this->PlaylistModel->pager;
        $data['jPlaylist'] = count($data['playlist']);
        return view('frontend/' . templates()->folder . '/galeri/playlist', $data);
    }

    public function playlist_detail($a, $b)
    {
        $playlist = $this->PlaylistModel->get_playlist_by_id($a);
        $data['title'] = 'Galeri Video ' . $playlist->nm_playlist;
        $data['video'] = $this->VideoModel->where('playlist_id', $a)->orderBy('id_video', 'DESC')->paginate(10);
        $data['pager'] = $this->VideoModel->pager;
        $data['playlist'] = $this->PlaylistModel->get_playlist_where(['id_playlist !=' => $a, 'aktif' => 'Y'], NULL, 3);
        $data['jPlaylist'] = count($data['playlist']);
        return view('frontend/' . templates()->folder . '/galeri/playlist_detail', $data);
    }
}
