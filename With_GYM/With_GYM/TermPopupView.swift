//
//  TermPopupView.swift
//  With_GYM
//
//  Created by 김용우 on 2017. 11. 9..
//  Copyright © 2017년 김용우. All rights reserved.
//

import UIKit

class TermPopupView: UIView {

    /*
    // Only override draw() if you perform custom drawing.
    // An empty implementation adversely affects performance during animation.
    override func draw(_ rect: CGRect) {
        // Drawing code
    }
    */
    let nc = NotificationCenter.default
    @IBOutlet weak var baseView: UIView!
    
    @IBOutlet weak var btnCancel: UIButton!
    @IBOutlet weak var btnAgree: UIButton!
    
    @IBAction func btnActCancel(_ sender: UIButton) {
        closeTapped()
        let data = false
        nc.post(name: NSNotification.Name("AcceptCheck"), object:data)
    }
    @IBAction func btnActCheck(_ sender: UIButton) {
        closeTapped()
        let data = true
        nc.post(name: NSNotification.Name("AcceptCheck"), object:data)
    }
    
    
    @IBAction func tapDownView(_ sender: UITapGestureRecognizer) {
        self.closeTapped()
    }
    func closeTapped() {
        self.removeFromSuperview()
    }
    
}
